import time
import datetime
import paho.mqtt.subscribe as subscribe
import paho.mqtt.publish as publish
import json
from kafka import KafkaProducer

producer = KafkaProducer(bootstrap_servers='localhost:9092', value_serializer=lambda v: json.dumps(v).encode('utf-8'))

def on_message(client, userdata, message):
    print("%s %s" % (message.topic, message.payload))
    data = ((message.payload).decode("utf-8"))
    cur = float(data)
    pow = int(cur*230)
    ts = round(time.time())

    print(type(ts))
    print(ts)
    print(pow)

    producer.send('power', {"timestamp":ts , "sensor" : "piSensor" , "powerValue" : pow})

subscribe.callback(on_message, "Current", hostname="192.168.1.55")
