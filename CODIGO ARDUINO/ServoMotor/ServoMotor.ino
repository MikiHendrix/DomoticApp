#include<Servo.h>

Servo servoMotor;
int angulo;
int pinServo = 12;
unsigned char comando;
void setup() {
  Serial.begin(9600);
   servoMotor.attach(pinServo, 650, 2550);
}

void loop() {
  comando = 0;
  if(Serial.available()){
    comando = Serial.read();
    if(comando == 'q'){
      AbrirPuerta();
    }else if(comando == 'r'){
      CerrarPuerta();
    }  
    
  }  
}
void CerrarPuerta(){
      angulo = 100;
      angulo = constrain(angulo,0,180);
      servoMotor.write(angulo);
      delay(5000);
      servoMotor.write(80);
      angulo = 0;
}
        
void AbrirPuerta(){ 
   angulo -= 80;
   angulo = constrain(angulo,0,180);
   servoMotor.write(angulo);
   delay(4000);
   servoMotor.write(80);
   angulo = 0;
}

