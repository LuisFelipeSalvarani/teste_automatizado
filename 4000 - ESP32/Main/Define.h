// ID do jardim e da área
#define id_jardim String(6)
#define id_area String(21)

// Tópicos MQTT para publicação de dados do dispositivo e status
#define AWS_IOT_PUBLISH_DISPOSITIVO ("irrigacao/dispositivo/" + String(id_jardim) + "/" + String(id_area)).c_str()
#define AWS_IOT_PUBLISH_STATUS ("irrigacao/status/" + String(id_jardim) + "/" + String(id_area)).c_str()

// Tópicos MQTT para subscrição de comandos e parâmetros
#define AWS_IOT_SUBSCRIBE_COMANDO ("irrigacao/comando/" + String(id_jardim) + "/" + String(id_area)).c_str()
#define AWS_IOT_SUBSCRIBE_PARAMETRO ("irrigacao/parametro/" + String(id_jardim) + "/" + String(id_area)).c_str()

// Tamanho máximo do pacote MQTT
#define MQTT_MAX_PACKET_SIZE 512   

// Definições dos pinos dos dispositivos
#define DHTTYPE DHT11
#define DHTPin 4
#define SensorUmidadePin 36
#define ValvulaPin 12
#define MotorPin 13