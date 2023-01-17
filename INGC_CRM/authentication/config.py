import sqlite3

conn = sqlite3.connect('authentication\\test.db', check_same_thread=False) 
# conn.get_engine(True)
print ("Opened database successfully") 

data = conn.execute("select * from Employees")
print(data)