// Configurações da rede MQTT
const char* mqtt_server = "192.168.0.110";  // Endereço do servidor MQTT
const int mqtt_port = 1883;                 // Porta do servidor MQTT

void setupMqtt() {
  client.setBufferSize(MQTT_MAX_PACKET_SIZE);
  client.setServer(mqtt_server, mqtt_port);
  client.setCallback(callback);
}

// Função para reconectar ao servidor MQTT
void reconnect() {
  while (!client.connected()) {
    Serial.print("Tentando se conectar ao MQTT Broker...");  // Imprime uma mensagem de tentativa de conexão
    if (client.connect("ESP32Client")) {  // Tenta reconectar ao servidor MQTT
      Serial.println("Conectado");         // Imprime uma mensagem de conexão bem-sucedida
      client.subscribe(AWS_IOT_SUBSCRIBE_COMANDO);   // Inscreve-se no tópico de comandos MQTT
      client.subscribe(AWS_IOT_SUBSCRIBE_PARAMETRO);  // Inscreve-se no tópico de parâmetros MQTT
    } else {
      Serial.print("Falha na conexão, código de erro = ");  // Imprime uma mensagem de falha na conexão
      Serial.println(client.state());                        // Imprime o código de erro
      delay(5000);  // Aguarda 5 segundos antes de tentar reconectar novamente
    }
  }
}

// Função de retorno de chamada para mensagens MQTT recebidas
void callback(char* topic, byte* payload, unsigned int length) {
  Serial.print("Mensagem recebida no tópico: ");
  Serial.println(topic);
  Serial.print("Conteúdo da mensagem: ");
  for (int i = 0; i < length; i++) {
    Serial.print((char)payload[i]);
  }
  Serial.println();

  // Processa os dados JSON recebidos
  processarDadosJSON(payload, topic);
}

// Função para processar dados JSON recebidos
void processarDadosJSON(byte* payload, char* topic) {
  const size_t capacidadeJson = JSON_OBJECT_SIZE(8) + 180;  // Calcula a capacidade do documento JSON
  DynamicJsonDocument doc(capacidadeJson);  // Cria um documento JSON dinâmico com a capacidade calculada

  DeserializationError erro = deserializeJson(doc, payload);  // Deserializa os dados JSON recebidos
  
  if (erro) {  // Verifica se ocorreu algum erro na deserialização
    Serial.print("deserializeJson() falhou: ");  // Imprime uma mensagem de erro
    Serial.println(erro.c_str());                 // Imprime o código de erro
    return;
  }

  // Processa mensagens de parâmetros
  if (strcmp(topic, AWS_IOT_SUBSCRIBE_PARAMETRO) == 0) {
    parametro.limite_iniciar_umidade = doc["min_umidade"];
    parametro.limite_parar_umidade = doc["max_umidade"];
    parametro.limite_iniciar_temperatura = doc["min_temperatura"];
    parametro.limite_parar_temperatura = doc["max_temperatura"];
    parametro.limite_minimo_consumo = doc["min_volume"];
    parametro.limite_maximo_consumo = doc["max_volume"];
    separarHoraMinuto(doc["hora_inicio"],parametro.hora_inicio,parametro.minuto_inicio);
    separarHoraMinuto(doc["duracao"],parametro.hora_fim,parametro.minuto_fim);
    parametro.duracao = 360;
    parametro.segunda = doc["segunda"];
    parametro.terca = doc["terca"];
    parametro.quarta = doc["quarta"];
    parametro.quinta = doc["quinta"];
    parametro.sexta = doc["sexta"];
    parametro.sabado = doc["sabado "];
    parametro.domingo = doc["domingo"];
  }

  // Processa mensagens de comandos
  if (strcmp(topic, AWS_IOT_SUBSCRIBE_COMANDO) == 0) {
    comando.automatico = doc["automatico"];
    comando.valvula = doc["valvula"];
    comando.motor = doc["motor"];  
    comando.controle_temperatura = doc["controle_temperatura"];
    comando.controle_umidade = doc["controle_umidade"];
    comando.controle_consumo = doc["controle_consumo"];

    comand_status();
  }
}

// Função para enviar leituras dos dispositivos para a nuvem
void sensors() {
  StaticJsonDocument<200> doc;  // Cria um documento JSON estático com tamanho de 200 bytes
  doc["descricao"] = "Dispositivos";  // Adiciona uma descrição ao documento JSON
  doc["id_jardim"] = id_jardim;       // Adiciona o ID do jardim ao documento JSON
  doc["id_area"] = id_area;           // Adiciona o ID da área ao documento JSON
  // Adiciona leituras dos sensores ao documento JSON
  doc["temperatura"] = dispositivo.temperatura;
  doc["umidade_ar"] = dispositivo.umidade_ar;
  doc["umidade_solo"] = dispositivo.umidade_solo;
  doc["vazao"] = dispositivo.vazao;
  doc["consumo_agua"] = dispositivo.consumo_agua;
  doc["valvula"] = dispositivo.valvula;
  doc["motor"] = dispositivo.motor;
  char jsonBuffer[256];  // Cria um buffer para armazenar o JSON
  serializeJson(doc, jsonBuffer);  // Serializa o documento JSON para o buffer
  client.publish(AWS_IOT_PUBLISH_DISPOSITIVO, jsonBuffer);  // Publica o JSON no tópico MQTT
}

// Função para enviar o status do sistema para a nuvem
void comand_status() {
  status.automatico = comando.automatico;
  status.valvula = comando.valvula;
  status.motor = comando.motor;
  status.controle_consumo = comando.controle_consumo;
  status.controle_temperatura = comando.controle_temperatura;
  status.controle_umidade = comando.controle_umidade;

  StaticJsonDocument<200> doc;  // Cria um documento JSON estático com tamanho de 200 bytes
  doc["descricao"] = "Status do sistema";  // Adiciona uma descrição ao documento JSON
  doc["id_jardim"] = id_jardim;            // Adiciona o ID do jardim ao documento JSON
  doc["id_area"] = id_area;                // Adiciona o ID da área ao documento JSON
  // Adiciona o status do sistema ao documento JSON
  doc["automatico"] = status.automatico;
  doc["valvula"] = status.valvula;
  doc["motor"] = status.motor;
  doc["controle_temperatura"] = status.controle_temperatura;
  doc["controle_umidade"] = status.controle_umidade;
  doc["controle_consumo"] = status.controle_consumo;
  char jsonBuffer[256];  // Cria um buffer para armazenar o JSON
  serializeJson(doc, jsonBuffer);  // Serializa o documento JSON para o buffer
  client.publish(AWS_IOT_PUBLISH_STATUS, jsonBuffer);  // Publica o JSON no tópico MQTT
}