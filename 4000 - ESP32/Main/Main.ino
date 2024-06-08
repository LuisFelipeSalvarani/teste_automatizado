#include <WiFi.h>               // Inclui a biblioteca para conexão WiFi
#include <PubSubClient.h>       // Inclui a biblioteca para comunicação MQTT
#include <TimeLib.h>            // Inclui a biblioteca para manipulação de tempo
#include <WiFiUdp.h>            // Inclui a biblioteca para comunicação UDP via WiFi
#include <NTPClient.h>          // Inclui a biblioteca para cliente NTP
#include <DHT.h>                // Inclui a biblioteca para o sensor DHT (umidade e temperatura)
#include <ArduinoJson.h>        // Inclui a biblioteca para manipulação de JSON
#include "Structs.h"            // Incluir o arquivo de cabeçalho das structs
#include "Define.h"             // Incluir o arquivo de cabeçalho das defines

WiFiClient espClient;               // Cria um cliente WiFi
PubSubClient client(espClient);     // Cria um cliente MQTT

Parametro parametro;      // Instância da estrutura de parâmetros
Dispositivo dispositivo;  // Instância da estrutura de dispositivos
Comando comando;          // Instância da estrutura de comandos
Status status;            // Instância da estrutura de status
DHT dht(DHTPin, DHTTYPE); // Cria um objeto para o sensor DHT

unsigned long lastSensorsSending = 0;   // Armazena o último momento em que as leituras dos sensores foram enviadas
unsigned long lastStatusSending = 0;    // Armazena o último momento em que o status do sistema foi enviado
unsigned long lastSensorTimer = 1000;   // Intervalo de tempo entre os envios de leituras dos sensores
unsigned long tempo_atual = 0;          // Armazena o tempo atual em milissegundos
unsigned long ultimo_tempo_flip = 0;    // Armazena o último tempo em que houve inversão de estado
bool estado_flip = false;               // Armazena o estado atual da inversão (ligado/desligado)

const unsigned long tempo_ligado = 10000;     // Tempo em milissegundos que o dispositivo fica ligado
const unsigned long tempo_desligado = 10000;  // Tempo em milissegundos que o dispositivo fica desligado
unsigned int ultimo_dia = 0;                  // Armazena o último dia registrado
unsigned long tempo_ligado_acumulado = 0;     // Armazena o tempo total em milissegundos que o dispositivo esteve ligado
float vazao_bomba = 800.0;                    // Define a vazão da bomba de água em litros por hora

// Variáveis do filtro de Kalman para umidade do solo
float x_est = 0.0;   // Estimativa inicial
float P = 1.0;       // Covariância inicial do erro de estimativa
const float Q = 0.01; // Variância do processo (ajustável)
const float R = 0.5;  // Variância da medição (ajustável)

void setup() {
  Serial.begin(115200);                     // Inicia a comunicação serial com a velocidade de 115200 bps
  connectWiFi();                            // Inicia a conexão WiFi
  setupNtp();                               // Inicializa o cliente NTP para obter a hora atual
  setupMqtt();                              // Configura o cliente MQTT para comunicação
  controlar_valvula(false);                 // Desliga a válvula ao iniciar o sistema
  controlar_motor(false);                   // Desliga o motor ao iniciar o sistema
  ConfigInicial();

  pinMode(DHTPin, INPUT);                   // Define o pino do sensor DHT como entrada
  dht.begin();                              // Inicializa o sensor DHT
  pinMode(SensorUmidadePin, INPUT);         // Define o pino do sensor de umidade                      
  pinMode(MotorPin, OUTPUT);                // Define o pino do motor como saída
  pinMode(ValvulaPin, OUTPUT);              // Define o pino da válvula como saída
}

void loop() {
  if (!client.connected()) {
    reconnect();  // Reconecta ao servidor MQTT, se não estiver conectado
  }
  client.loop();  // Mantém a conexão MQTT ativa

  // Obtém o tempo atual em milissegundos desde que o programa começou a ser executado
  tempo_atual = millis();

  // Realiza leituras dos sensores
  dispositivo.temperatura = dht.readTemperature();
  dispositivo.umidade_ar = dht.readHumidity();

  // Leitura da umidade do solo e aplicação do filtro de Kalman
  float z = analogRead(SensorUmidadePin);  // Medição do sensor
  // Filtro de Kalman
  float x_pred = x_est;   // Previsão (Predição)
  float P_pred = P + Q;   // Atualiza a covariância da previsão
  float K = P_pred / (P_pred + R);  // Calcula o ganho de Kalman
  x_est = x_pred + K * (z - x_pred); // Atualiza a estimativa com a medição
  P = (1 - K) * P_pred;              // Atualiza a covariância da estimativa
  dispositivo.umidade_solo = map(x_est, 0, 1300, 0, 100);
  //dispositivo.umidade_solo = map(analogRead(SensorUmidadePin), 4095, 1300, 0, 100);

  //Cálculo para consumo de água
  dispositivo.consumo_agua = vazao_bomba/3600000.0 * (tempo_ligado_acumulado);
  
  // Envia leituras dos sensores para a nuvem periodicamente
  if (millis() - lastSensorsSending > lastSensorTimer) {
    sensors();
    lastSensorsSending = millis();
  }

  // Envia o status do sistema para a nuvem periodicamente
  if (millis() - lastStatusSending > 60000) {
    comand_status();
    lastStatusSending = millis();
  }
  
  if (comando.automatico) {
    //Automático
    // Verifica se as condições ideais foram atendidas e controla a irrigação
    bool return_condicoes = controlar_irrigacao();
    controlar_valvula(return_condicoes);  // Liga a valvula
    controlar_motor(return_condicoes);  // Liga o motor
  } else {
    //Manual
    controlar_valvula(comando.valvula);  // Liga a valvula
    controlar_motor(comando.motor);  // desliga a valvula
  }  
}

// Função para verificar se a hora atual está dentro do intervalo ideal
bool hora_ideal() {
  int hora_atual = hour();  // Obtém a hora atual
  int minuto_atual = minute();  // Obtém a minuto atual
  int hora_minuto_atual = hora_atual * 60 + minuto_atual;
  int hora_minuto_inicio = parametro.hora_inicio * 60 + parametro.minuto_inicio;
  int hora_minuto_fim = parametro.hora_fim * 60 + parametro.minuto_fim;

  return hora_minuto_atual >= hora_minuto_inicio && hora_minuto_atual <= hora_minuto_fim;
}

bool duracao_ideal() {
  unsigned long duracao = tempo_ligado_em_minutos();
  return duracao < parametro.duracao;
}

bool semana_ideal() {
  // Obtém o dia da semana
  int dia_da_semana = weekday();

  // Exibe o dia da semana
  switch (dia_da_semana) {
    case 1:
      return parametro.domingo; 
    case 2:
      return parametro.segunda;
    case 3:
      return parametro.terca;
    case 4:
      return parametro.quarta;
    case 5:
      return parametro.quinta;
    case 6:
      return parametro.sexta;
    case 7:
      return parametro.sabado;
  }
}

// Função para retornar o tempo total ligado em minutos
unsigned long tempo_ligado_em_minutos() {
  return tempo_ligado_acumulado / 60000;  // Convertendo milissegundos para minutos
}

// Função para verificar se a temperatura está dentro dos limites ideais
bool temperatura_ideal() {
  return dispositivo.temperatura >= parametro.limite_iniciar_temperatura && dispositivo.temperatura <= parametro.limite_parar_temperatura;
}

// Função para verificar se a umidade do solo está dentro dos limites ideais
bool umidade_solo_ideal() {
  static bool umidade_ativa;
  if (dispositivo.umidade_solo <= parametro.limite_iniciar_umidade) {
    umidade_ativa = 1;
  }

  if (dispositivo.umidade_solo >= parametro.limite_parar_umidade) {
    umidade_ativa = 0;
  }

  return umidade_ativa;
}

// Função para verificar se o consumo de água está dentro do limite ideal
bool consumo_ideal() {
  return dispositivo.consumo_agua <= parametro.limite_maximo_consumo;
}

// Função para alternar o estado com tempos específicos de ligado e desligado
bool flip(unsigned long tempo_ligado, unsigned long tempo_desligado) {  
  if (estado_flip && (tempo_atual - ultimo_tempo_flip >= tempo_ligado)) {
    estado_flip = false;
    ultimo_tempo_flip = tempo_atual;
  } else if (!estado_flip && (tempo_atual - ultimo_tempo_flip >= tempo_desligado)) {
    estado_flip = true;
    ultimo_tempo_flip = tempo_atual;
  }
  return estado_flip;
}

bool controlar_irrigacao() {
  bool hora = hora_ideal();
  bool duracao = duracao_ideal();
  bool semana = semana_ideal();
  bool temperatura;
  bool umidade;
  bool consumo;
  bool irrigacao_ativa;
  bool irrigacao_intermitente;
  static unsigned long ultimo_tempo_verificacao = 0;

  if (comando.controle_temperatura) {
    temperatura = temperatura_ideal();
  } else {
    temperatura = 1;
  }

  if (comando.controle_umidade) {
    umidade = umidade_solo_ideal();
  } else {
    umidade = 1;
  }

  if (comando.controle_consumo) { 
    consumo = consumo_ideal();
  } else {
    consumo = 1;
  }
  
  // Lógica de controle de irrigação com base nas condições de controle
  if (comando.controle_umidade) {
    irrigacao_ativa = hora && duracao && semana && umidade && temperatura && consumo;
  } else if (comando.controle_temperatura || comando.controle_consumo) {
    irrigacao_intermitente = flip(tempo_ligado, tempo_desligado);
    irrigacao_ativa = hora && duracao && semana && temperatura && consumo && irrigacao_intermitente;  
  } else {
    irrigacao_ativa = false;
  }

  // Acumula o tempo ligado sempre que a irrigação está ativa
  if (irrigacao_ativa) {
    tempo_ligado_acumulado += (tempo_atual - ultimo_tempo_verificacao);
  }
  ultimo_tempo_verificacao = tempo_atual;

  // Resetar o tempo acumulado se o dia mudou ou a hora é 0 (meia-noite)
  if (day() != ultimo_dia || hour() == 0) {
    tempo_ligado_acumulado = 0;
    ultimo_dia = day();
  }
  return irrigacao_ativa;
}

// Função para controlar a válvula
void controlar_valvula(bool ligada) {
  // Define o estado da válvula com base no parâmetro 'ligada'
  digitalWrite(ValvulaPin, ligada ? LOW : HIGH);
  // Atualiza o estado da válvula na estrutura 'dispositivo'
  dispositivo.valvula = ligada ? (10 + comando.automatico) : 0;
}

// Função para controlar o motor
void controlar_motor(bool ligado) {
  // Define o estado do motor com base no parâmetro 'ligado'
  digitalWrite(MotorPin, ligado ? LOW : HIGH);
  // Atualiza o estado do motor na estrutura 'dispositivo'
  dispositivo.motor = ligado ? (10 + comando.automatico) : 0;
  // Simula a vazão da bomba
  dispositivo.vazao = ligado ? vazao_bomba : 0.00;
}