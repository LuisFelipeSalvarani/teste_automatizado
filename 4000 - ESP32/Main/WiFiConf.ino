const char* ssid = "House X New Router";
const char* password = "Alice@2017&Linda";

//const char* ssid = "HydroFlow";
//const char* password = "HydroFlow@123";

/*const char* ssid = "Fatec24GHz";
const char* password = "fatecitapira";*/

/*const char* ssid = "AliceLaura-2G";
const char* password = "DaianeBruno22";*/

/*const char* ssid = "iPhone de Bruno Gomes";
const char* password = "20632746";*/


void connectWiFi() {
  Serial.println("Connecting");
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("Ready");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}
