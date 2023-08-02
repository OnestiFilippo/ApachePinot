from pinotdb import connect
import time
import json
import os

conn = connect(host='localhost', port=8099, path='/query/sql', scheme='http')
curs = conn.cursor()

while True:
  if(os.path.exists("query.txt")):
    f = open("query.txt", "r")
    query = f.read()
    print(query)
    f.close()
    outfile = open("response.json","w")
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
    os.remove("query.txt")
