from kafka import KafkaProducer
import json
import random
import time
import datetime

producer = KafkaProducer(bootstrap_servers='localhost:9092', value_serializer=lambda v: json.dumps(v).encode('utf-8'))

while True:
    ts = round(time.time())
    
    producer.send('power', {"timestamp":ts , "sensor" : "piSensor" , "powerValue" : random.randint(0,1000)})
    time.sleep(1)
