import mysql.connector
import serial
import time
from datetime import datetime


mydb = mysql.connector.connect(host="localhost",user="admin",password="admin",database="db_rfid")
mycursor = mydb.cursor()

def getModule(id_smstr):
    now = datetime.now()
    currentHour = now.strftime('%H')
    currentDay = now.strftime('%A')
    i=0
    if(int(currentHour)>=8 and int(currentHour)<=13 and currentDay=="Monday" and id_smstr==1):
            i=1
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Monday" and id_smstr==1):
            i=2
            
    if(int(currentHour)>=8 and int(currentHour)<=12 and currentDay=="Tuesday" and id_smstr==1):
            i=3
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Tuesday" and id_smstr==1):
            i=4
          
    if(int(currentHour)>=8 and int(currentHour)<=12 and currentDay=="Wednesday" and id_smstr==1):
            i=5
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Wednesday" and id_smstr==1):
            i=6
            
    if(int(currentHour)>=8 and int(currentHour)<=12 and currentDay=="Thursday" and id_smstr==1):
            i=2
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Thursday" and id_smstr==1):
            i=4
            
    if(int(currentHour)>=8 and int(currentHour)<=12 and currentDay=="Friday" and id_smstr==1):
            i=1
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Friday" and id_smstr==1):
            i=3
    if(int(currentHour)>=8 and int(currentHour)<=12 and currentDay=="Saturday" and id_smstr==1):
            i=3
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Saturday" and id_smstr==1):
            i=1
    if(int(currentHour)>=8 and int(currentHour)<=13 and currentDay=="Monday" and id_smstr==2):
            i=7
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Monday" and id_smstr==2):
            i=8
            
    if(int(currentHour)>=8 and int(currentHour)<=12 and currentDay=="Tuesday" and id_smstr==2):
            i=9
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Tuesday" and id_smstr==2):
            i=10
          
    if(int(currentHour)>=8 and int(currentHour)<=12 and currentDay=="Wednesday" and id_smstr==2):
            i=11
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Wednesday" and id_smstr==2):
            i=12
            
    if(int(currentHour)>=8 and int(currentHour)<=12 and currentDay=="Thursday" and id_smstr==2):
            i=10
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Thursday" and id_smstr==2):
            i=8
            
    if(int(currentHour)>=8 and int(currentHour)<=12 and currentDay=="Friday" and id_smstr==2):
            i=12
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Friday" and id_smstr==2):
            i=9
    if(int(currentHour)>=8 and int(currentHour)<=12 and currentDay=="Saturday" and id_smstr==2):
            i=12
    elif(int(currentHour)>=14 and int(currentHour)<=18 and currentDay=="Saturday" and id_smstr==2):
            i=9
    return i

while 1:
    arduino = serial.Serial('/dev/ttyACM0')
    arduino.baudrate = 9600
    time.sleep(1)
    line = arduino.readline().decode('utf-8').rstrip()
    print(line)
    val1 = line
    
    now = datetime.now()
    currentdate = now.strftime('%Y-%m-%d %H:%M:%S')
    
    mycursor.execute("select personne.id from personne join rfid where personne.rfid_id = rfid.id and rfid.rfid like '"+val1+"'")
    id_persn = mycursor.fetchall()[0][0]
    print(id_persn)
    mycursor.execute("select personne.idSemestre from personne join rfid where personne.rfid_id = rfid.id and rfid.rfid like '"+val1+"'")
    id_smstr = mycursor.fetchall()[0][0]
    print(id_smstr)
    id_module = 1
    if (id_module !="" or id_module != 0):
        print(id_module)
        sql2 = "INSERT INTO presence (date, idPersonne,idModule) VALUES ( %s,%s,%s)"
        val = (currentdate,id_persn,id_module)
        mycursor.execute(sql2,val)
        mydb.commit()





#if val1 !="":
#    mycursor.execute(sql, (val1,val2))
 #   mydb.commit()
  #  print(mycursor.rowcount, "record inserted.")
#else:
 #   print('no valeur inserer')
 
 







