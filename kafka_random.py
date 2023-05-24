from kafka import KafkaProducer
import json
import random
import time

producer = KafkaProducer(bootstrap_servers='localhost:9092', value_serializer=lambda v: json.dumps(v).encode('utf-8'))

for i in range(1000):
    ts = time.time()
    producer.send('curtopic',{"sensor": "sensore1", "value": random.randint(0,500), "timestamp": int(ts)})
    time.sleep(1)
producer.flush()
