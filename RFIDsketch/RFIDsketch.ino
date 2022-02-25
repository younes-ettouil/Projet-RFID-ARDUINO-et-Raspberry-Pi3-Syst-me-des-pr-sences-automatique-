#include <SPI.h>
#include <MFRC522.h>
#include <LiquidCrystal_I2C.h>
#define SS_PIN 10 //SDA pin
#define RST_PIN 9 //Reset pin

#define I2C_ADDR 0x27 //I2c Address
#define BACKLIGHT_PIN 3
#define En_pin 2
#define Rw_pin 1
#define Rs_pin 0
#define D4_pin 4
#define D5_pin 5
#define D6_pin 6
#define D7_pin 7

#define SS_PIN 10
#define RST_PIN 9

#define AccesFlag_PIN 2
#define Gate_PIN 3
#define Max_Acces 3
//44 B6 A 85

byte Count_acces = 0;
byte CodeVerif = 0;
byte CodeVerif2 = 0;
byte CodeVerif3 = 0;
byte CodeVerif4 = 0;
byte Code_Acces[4] = {0x44, 0xB6, 0xA, 0x85};
byte Code_Acces2[4]={5 ,0x1, 0x6C, 0x63};
byte Code_Acces3[4]={0x16,0xFF,0x1F,0x9E};
byte Code_Acces4[4]={4,0x6F,0x38,0x42};
MFRC522 rfid(SS_PIN, RST_PIN); // Instance of the class
LiquidCrystal_I2C lcd(I2C_ADDR,En_pin,Rw_pin,Rs_pin,D4_pin,D5_pin,D6_pin,D7_pin);
// Init array that will store new NUID
byte nuidPICC[4];

void setup()
{
  // Init RS232
  Serial.begin(9600);

  // Init SPI bus
  SPI.begin();

  // Init MFRC522
  rfid.PCD_Init(); 
  
  lcd.begin (16,2);
  lcd.setBacklightPin(BACKLIGHT_PIN,POSITIVE);
  lcd.setBacklight(HIGH);
  lcd.setCursor (0,0);
  lcd.print("veuillez mettre"); //Showing hello on the screen of 3s
  lcd.setCursor (0,1);
  lcd.print("  votre carte");
 
  // Init LEDs
  pinMode(AccesFlag_PIN, OUTPUT);
  pinMode(Gate_PIN, OUTPUT);

  digitalWrite(AccesFlag_PIN, LOW);
  digitalWrite(Gate_PIN, LOW);
}

void loop()
{
  // Initialisé la boucle si aucun badge n'est présent
  if ( !rfid.PICC_IsNewCardPresent())
    return;

  // Vérifier la présence d'un nouveau badge
  if ( !rfid.PICC_ReadCardSerial())
    return;

  // Afffichage
//  Serial.println(F("Un badge est détecté"));

  // Enregistrer l’ID du badge (4 octets)
  for (byte i = 0; i < 4; i++) {
    nuidPICC[i] = rfid.uid.uidByte[i];
  }

  // Vérification du code
  CodeVerif = GetAccesState(Code_Acces, nuidPICC);
  CodeVerif2 = GetAccesState(Code_Acces2, nuidPICC);
  CodeVerif3 = GetAccesState(Code_Acces3, nuidPICC);
  CodeVerif4 = GetAccesState(Code_Acces4, nuidPICC);

  if (CodeVerif != 1 && CodeVerif2 != 1 && CodeVerif3!=1 && CodeVerif4!=1 )
  {
    // Affichage
    lcd.clear();
    lcd.setCursor (0,0);
    lcd.print("   Carte non");
    lcd.setCursor (0,1);
    lcd.print("     valide");
    // Un seul clignotement: Code erroné
    digitalWrite(AccesFlag_PIN, HIGH);
    delay(1000);
    digitalWrite(AccesFlag_PIN, LOW);
    delay(1000);
    lcd.clear();
    lcd.setCursor (0,0);
    lcd.print("veuillez mettre"); //Showing hello on the screen of 3s
    lcd.setCursor (0,1);
    lcd.print("  votre carte");


  }
  else
  {
 
    lcd.clear();
    lcd.setCursor (0,0);
    lcd.print("    Presence");
    lcd.setCursor (0,1);
    lcd.print("     valide");
    // Ouverture de la porte & Initialisation
    digitalWrite(Gate_PIN, HIGH);
    delay(1000);
    digitalWrite(Gate_PIN, LOW);
    Count_acces = 0;
    delay(1000);
    lcd.clear();
    lcd.setCursor (0,0);
    lcd.print("veuillez mettre"); //Showing hello on the screen of 3s
    lcd.setCursor (0,1);
    lcd.print("  votre carte");
  }

  // Affichage de l'identifiant
//  Serial.println(" L'UID du tag est:");
  for (byte i = 0; i < 4; i++)
  {
    Serial.print(nuidPICC[i], HEX);
    Serial.print(" ");
  }
  Serial.println();

  // Re-Init RFID
  rfid.PICC_HaltA(); // Halt PICC
  rfid.PCD_StopCrypto1(); // Stop encryption on PCD
}

byte GetAccesState(byte *CodeAcces, byte *NewCode)
{
  byte StateAcces = 0;
  if ((CodeAcces[0] == NewCode[0]) && (CodeAcces[1] == NewCode[1]) &&
      (CodeAcces[2] == NewCode[2]) && (CodeAcces[3] == NewCode[3]))
    return StateAcces = 1;
  else
    return StateAcces = 0;
}
