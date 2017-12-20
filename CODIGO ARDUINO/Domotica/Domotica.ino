#include <Servo.h>

#include "DHT.h" 
#include <SoftwareSerial.h>
#include<Servo.h>

Servo servoMotor;
int angulo;
int pinServo = 12;



SoftwareSerial BT1(4,2); // TX, RX
int alarmaExtractor = 11;
int sensorHumos = A0;
//Almacena las lecturas del sensor de humos.
int sensorValue = 0;
int hab1 = 8;
int hab2 = 9;
int salon = 10;
int fan = 5;
int temp = 30;
int swTono = 0;
char c;
//variables de humedad y temperatura
float h,t; 
char dato;
#define DHTTYPE DHT22   
#define DHTPIN 3
DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(9600); 
  
  //definimos el pin del servo al objeto servoMotor, con minimo y máximo de pulso (potencia)
servoMotor.attach(pinServo, 650, 2550); //pulsos en microsegundos. 1 milisegundo = 1000 microsegundos

  BT1.begin(9600);
  pinMode(fan,OUTPUT); 
  pinMode(hab1,OUTPUT);
  pinMode(hab2,OUTPUT);
  pinMode(salon,OUTPUT);
  pinMode(alarmaExtractor, OUTPUT);
  dht.begin();  
}

void loop() { 
EnviarTemperatura();  
EnviarHumedad();  
delay(1000);  
   if (BT1.available()){
        c = (char)BT1.read();
        Serial.println(c);        
        //Luces
        switch(c){
          case 'a':
            digitalWrite(8,HIGH);
            break;
          case 'b':
            digitalWrite(8,LOW);
            break;
          case 'c':
            digitalWrite(9,HIGH);
            break;
          case 'd':
            digitalWrite(9,LOW);
            break;
          case 'l':
            digitalWrite(10,HIGH);
            break;  
          case 'm':
            digitalWrite(10,LOW);
            break;  
          case 'e':
            temp = 20;  
            break;  
          case 'f':
            temp = 22; 
            break;
          case 'g':
            temp = 24; 
            break;  
          case 'h':
            temp = 26; 
            break;
          case 'i':
            temp = 28;
            break;  
          case 'p':
            EnviarHumedad();
            break;
          case 'j':
            swTono = 0;
            break;
          case 'q':
            AbrirPuerta();
            break;
          case 'r':
            CerrarPuerta();
            break;
    } 
 } 
 
  sensorValue = analogRead(sensorHumos);   
  if (sensorValue > 100) 
  {  
    swTono = 1;
    BT1.println('k');
    
  }   
  Serial.println(sensorValue);
  if(swTono == 1)
  {
    tone(13, 300, 500);
    delay(1000);
    digitalWrite(alarmaExtractor, HIGH);    
    tone(13, 450, 500);
    delay(2000);
    digitalWrite(alarmaExtractor, LOW);
  }

 if (t >= temp){
     digitalWrite(fan,HIGH);
   }else {
     digitalWrite(fan,LOW);
   }
}
void EnviarTemperatura(){
  t = dht.readTemperature(); //Lee la temperatura
  if (isnan(t)){ //Comprueba que el dato es un número
     Serial.print("Error");
  } else {   
    Serial.println(t);
     BT1.print("c"); 
     BT1.print(t);
  }
}

void EnviarHumedad()
{
  h = dht.readHumidity(); //Lee la humedad
  if (isnan(h)){ //Comprueba que el dato es un número
    Serial.print("Error");
  } else {
    Serial.println(h);
    BT1.print("h");
    BT1.println(h); //Envía el dato por el puerto serie    
  }
}


void CerrarPuerta(){
      angulo = 180;
      angulo = constrain(angulo,0,180);
      servoMotor.write(angulo);
      delay(4000);
      servoMotor.write(80);
      angulo = 0;
}
        
void AbrirPuerta(){ 
   angulo -= 160;
   angulo = constrain(angulo,0,180);
   servoMotor.write(angulo);
   delay(4000);
   servoMotor.write(80);
   angulo = 0;
}

