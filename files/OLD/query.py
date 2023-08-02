from pinotdb import connect
import time
import json
import sys


query = sys.argv[1]
print(query)

conn = connect(host='localhost', port=8099, path='/query/sql', scheme='http')
curs = conn.cursor()
curs.execute(query)
outfile = open("response.txt","w")

x = ""
for row in curs:
    x += str(row) + "\n"

print(x)
outfile.write(x)