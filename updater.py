import MySQLdb
import random
import time
import os

ip_address = "www.google.com"								# direccion o url remota

def add_data():
	db = MySQLdb.connect(host="localhost", user="ping", passwd="pingpassword",db="ping")
	cursor = db.cursor()
	datos=list()
    #ping a la direccion ip
	ping_result=os.popen("ping -c 3 "+ip_address).read()
    #[1:4] tomar solo 3 lineas del resultado
	for linea in ping_result.split("\n")[1:4]:
		datos.append(float(linea[linea.rfind("=")+1:linea.rfind(" ms")+1]))
	promedio=round(sum(datos)/len(datos),2)
	#minimo=min(datos)
	#maximo=max(datos)
	query="INSERT INTO latencia (hora, retraso) VALUES ("+str(time.time())+","+str(promedio)+")"
	print(query)
	cursor.execute(query)
	db.commit()
    
def clean():
    db = MySQLdb.connect(host="localhost", user="ping", passwd="pingpassword",db="ping")
    cursor = db.cursor()    
    query="DELETE FROM latencia WHERE 1;"
    print(query)
    cursor.execute(query)
    db.commit()
    
def main():
    stop = 25
    while(stop):
        add_data()
        time.sleep(random.randint(1,5))
        print(stop)
        stop-=1

if __name__=='__main__':
    main()