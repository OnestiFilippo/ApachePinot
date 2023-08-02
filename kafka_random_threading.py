from pinotdb import connect
import time
import json
import os
from threading import Thread
import datetime
import random
import json
from kafka import KafkaProducer

producer = KafkaProducer(bootstrap_servers='localhost:9092', value_serializer=lambda v: json.dumps(v).encode('utf-8'))

def rand_last():
    while True:
        ts = round(time.time()) + 7200
        
        val = random.randint(0,1000)
        print("datatetime:"+str(ts)+" - sensor:random - powerValue:"+str(val))
        producer.send('power', {"datetime":ts , "sensor" : "random" , "powerValue" : val})

        outfile = open("files/last.json","w")
        strfile = [ ts , val , 'piSensor']
        json.dump(strfile, outfile)
        outfile.close()

        time.sleep(2)

conn = connect(host='localhost', port=8099, path='/query/sql', scheme='http')
curs = conn.cursor()

def query():
    while True:
        if(os.path.exists("files/query.txt")):
            f = open("files/query.txt", "r")
            query = f.read()
            print(query)
            f.close()
            outfile = open("files/response.json","w")
            try:
                curs.execute(query)
                for row in curs:
                    print(row)
                    json.dump(str(row), outfile, indent=2)
                    outfile.write('\n')
                print()
            except:
                json.dump("ERROR", outfile, indent=2)
            outfile.close()
            os.remove("files/query.txt")

# create two new threads
t1 = Thread(target=rand_last)
t2 = Thread(target=query)

# start the threads
t1.start()
t2.start()

# wait for the threads to complete
t1.join()
t2.join()

