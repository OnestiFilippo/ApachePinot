from kafka import KafkaProducer
import json
import random
import time
import datetime

start = 1684965600

producer = KafkaProducer(bootstrap_servers='localhost:9092', value_serializer=lambda v: json.dumps(v).encode('utf-8'))

i=0

for i in range(0,8640):
    ts = round(time.time())
    producer.send('power', {"datetime":ts , "sensor" : "piSensor" , "powerValue" : random.randint(0,1000)})
    print(ts)
    time.sleep(0.001)

