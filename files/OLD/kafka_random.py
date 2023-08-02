from kafka import KafkaProducer
import json
import random
import time
import datetime

producer = KafkaProducer(bootstrap_servers='localhost:9092', value_serializer=lambda v: json.dumps(v).encode('utf-8'))

while True:
    ts = round(time.time()) + 7200
    
    val = random.randint(0,1000)
    producer.send('powerConsumption', {"datetime":ts , "sensor" : "piSensor" , "powerValue" : val})

    outfile = open("files/last.json","w")
    strfile = [ ts , val , 'piSensor']
    json.dump(strfile, outfile)
    outfile.close()

    time.sleep(1)
