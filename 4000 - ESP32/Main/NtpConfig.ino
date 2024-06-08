// Definição dos objetos UDP e NTPClient
WiFiUDP ntpUDP;
const long utcOffsetInSeconds = -3 * 3600; // UTC-3
NTPClient timeClient(ntpUDP, "pool.ntp.org", utcOffsetInSeconds, 60000); // Configura o cliente NTP para sincronizar a cada minuto

// Função para inicializar o cliente NTP
void setupNtp() {
  timeClient.begin();
  timeClient.update();
  setSyncProvider(getNtpTime);
  setSyncInterval(300); // Define o intervalo de sincronização para 5 minutos
}

// Função para obter a hora do NTP
time_t getNtpTime() {
  timeClient.update();
  return timeClient.getEpochTime();
}

// Função para separar a hora e o minuto de uma string no formato XX:XX
void separarHoraMinuto(const String& horaString, int& horas, int& minutos) {
  int separadorIndex = horaString.indexOf(':'); // Encontra a posição do separador ':'
  if (separadorIndex != -1) {
    horas = horaString.substring(0, separadorIndex).toInt(); // Extrai os caracteres antes do separador e converte para int
    minutos = horaString.substring(separadorIndex + 1).toInt(); // Extrai os caracteres após o separador e converte para int
  } else {
    horas = minutos = 0; // Caso não encontre o separador, define hora e minuto como 0
  }
}

