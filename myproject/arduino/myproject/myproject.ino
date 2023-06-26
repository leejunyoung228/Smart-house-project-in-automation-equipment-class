#include <ESP32_Servo.h>

#include "DHT.h"
#include <WiFi.h>

#ifndef STASSID
#define STASSID "bssm_free" //와이파이 검색했을때 뜨는 이름
#define STAPSK  "bssm_free" //패스워드
#endif

#define DHTPIN 16
#define DHTTYPE DHT11
#define ILLUMIPIN 36
#define LEDPIN 17
#define SERVOPIN 5

DHT dht(DHTPIN, DHTTYPE);
Servo myservo;

unsigned long sensor_timer = 0;
unsigned long control_timer = 0;

const char* ssid = STASSID;
const char* password = STAPSK;

const char * host = "10.150.149.34";
const int Port = 80;

int prepos = 0;

WiFiClient client;

bool getstate(String s);

void setup() {
  Serial.begin(115200);
  dht.begin();
  pinMode(LEDPIN, OUTPUT);
  digitalWrite(LEDPIN, LOW);
  myservo.attach(SERVOPIN);
  myservo.write(0);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  if (!client.connect(host, Port)) {
    Serial.println("connection failed");
    return;
  }
  if (millis() - sensor_timer > 1000) {
//    Serial.println("sensor");
    sensor_timer = millis();
    float h = dht.readHumidity();
    float t = dht.readTemperature();
    int cds = analogRead(ILLUMIPIN);
    if (isnan(h) || isnan(t)) {
      Serial.println(F("Failed to read from DHT sensor!"));
      return;
    }
    Serial.print("humi : ");
    Serial.print(h);
    Serial.print("% temp : ");
    Serial.print(t);
    Serial.print("°C illumi : ");
    Serial.println(cds);
    String url = "/myproject/insert.php?temp="+String(t)+"&humi="+String(h)+"&illumi="+String(cds)+"&device_id=device1";
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
    while(1){
      if(client.available()) break;
      if(millis() - sensor_timer > 10000) break;
    }
    while(client.available()){
      String line = client.readStringUntil('\n');
      if(line.indexOf("led") != -1){
        Serial.println(line);
        if(getstate(line)){
          digitalWrite(LEDPIN, HIGH);
        }else {
          digitalWrite(LEDPIN, LOW);
        }
      }
      if(line.indexOf("door") != -1){
        Serial.println(line);
        if(getstate(line)) {
//          while (prepos < 180) {
//            myservo.write(prepos);
//            delay(10);
//            prepos++;
//          }    
          myservo.write(180);      
        }else {
//          while (prepos > 0) {
//            myservo.write(prepos);
//            delay(10);
//            prepos--;
//          }
          myservo.write(0); 
        }
        
      }
//      Serial.println(line);
    }
    client.stop();
  }
}

bool getstate(String s) {
  bool state = false;
  if (s.indexOf("1") != -1) {
    state = true;
  }
  else if(s.indexOf("0") != -1) {
    state = false;
  }
  return state;
}
