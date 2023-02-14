import json
from django.shortcuts import render
import sqlite3
import hashlib
from rest_framework.decorators import api_view
from rest_framework.response import Response

conn = sqlite3.connect('authentication/test.db', check_same_thread=False) 
# conn.get_engine(True)
print ("Opened database successfully") 


#create employee table
# @app.route('/createemployees')
@api_view(['GET'])
def createemployees(request):
    conn.execute('''CREATE TABLE IF NOT EXISTS Employees (ID INTEGER PRIMARY KEY AUTOINCREMENT, NAME TEXT, EMAIL TEXT, PASSWORD TEXT);''')  
    
    return Response({"result": "Table employees created successfully"})

#create services table
# @app.route('/createservices')
@api_view(['GET'])
def createservices(request):
    conn.execute('''CREATE TABLE IF NOT EXISTS Services (ID INTEGER  PRIMARY KEY AUTOINCREMENT, SERVICE_NAME TEXT, START_TIME TEXT, END_TIME TEXT,Employee_ID INT,CONSTRAINT FK_Employee_ID FOREIGN KEY(Employee_ID) REFERENCES Employees(ID));''')
    
    return Response({"result": "Table services created successfully"})

#registration endpoint
# @app.route('/register',methods=['POST'])
@api_view(['POST'])
def register(request):
    data = request.data
    name = data["name"]
    email = data["email"]
    pd = data["password"]
    try:
        role_id = data["role"]
        ref_id = data["ref_id"]
    except:
        role_id = 1
        ref_id =0
    password = hashlib.md5(pd.encode('utf-8')).hexdigest()
    
    if not(bool(name)):
        return Response({"result":"name cannot be empty","status":400})
    elif not(bool(email)):
        return Response({"result":"email cannot be empty","status":400})
    elif not(bool(pd)):
        return Response({"result":"password cannot be empty","status":400})
    else:
        emaildata = conn.execute("SELECT * FROM Employees")
        data = []
        
        for row in emaildata:
            data.append(row[2])

        if email in data:
            return Response({"result":"email already exists","status":400})
    
        else:
            conn.execute("INSERT INTO Employees (NAME,EMAIL,PASSWORD,role_id,ref_id) VALUES ('"+name+"', '"+email+"', '"+password+f"', {role_id},{ref_id} )"); 
            conn.commit()  
            return Response({"result": "Registration succesfull","status":200})
        

#login endpoint
# @app.route('/login',methods=['POST'])
@api_view(['POST'])
def login(request):
    print("debug")
    data = request.data
    email = data["email"]
    pd = data["password"]
    password = hashlib.md5(pd.encode('utf-8')).hexdigest()

    if not(bool(email)):
        return Response({"result":"email cannot be empty","status":400})
    elif not(bool(pd)):
        return Response({"result":"password cannot be empty","status":400})
    else:
        emaildata = conn.execute("SELECT * FROM Employees")
        print(emaildata)
        # result = emaildata.fetchall()
        # print("debug"+ str(result))
        # return jsonify({"result": result}),200,{'ContentType':'application/json'}



        data = []

        for row in emaildata:
            data.append(row[2])
        print(data)
        if email in data:
           pwd = conn.execute("SELECT PASSWORD FROM Employees WHERE EMAIL='"+email+"'")
           pwd = pwd.fetchone()
           pwd = pwd[0]
           if pwd != password:
                return Response({"result": "invalid password","status":401})
           else:
                # session["email"] = email
                print("else statment")
                ans = conn.execute("SELECT ID,role_id,name,ref_id FROM Employees WHERE EMAIL='"+email+"'")
                id = ans.fetchone()
                print(type(id))
                new = id[0]
                roleid = id[1]
                print(roleid)
                return Response({"result":"login successfull","id":new , "role" :roleid,"name":id[2],"ref_id":id[3],"status":200})
        else:
            return Response({"result": "no such user exists"})
    

 
#logout endpoint
# @app.route("/logout")
@api_view(['GET'])
def logout(request):
    # session.pop('email', None)
    return Response({"result": "successfully logged out","status":200})


#endpoint for adding service
# @app.route('/add_service',methods=['POST'])
@api_view(['POST'])
def add_service(request):
    # if 'email' in session:

        data = request.data
        print("data : ", data)
        service_name = data["service_name"]
        START_TIME = data["start_time"]
        END_TIME = data["end_time"]
        Employee_ID = str(data["emp_id"])
        print(type(service_name),type(START_TIME),type(END_TIME),type(Employee_ID))

        if not(bool(service_name)):
            return Response({"result":"service name cannot be empty","status":400})
        elif not(bool(START_TIME)):
            return Response({"result":"start time cannot be empty","status":400})
        elif not(bool(END_TIME)):
            return Response({"result":"end time cannot be empty","status":400})
        else:

            conn.execute("INSERT INTO Services (SERVICE_NAME,START_TIME,END_TIME,Employee_ID) VALUES ('"+service_name+"', '"+START_TIME+"', '"+END_TIME+"', '"+Employee_ID+"')"); 
            conn.commit()  
            return Response({"result": "Services added successfully","status":200})
    # else:
    #     return jsonify({"result":"you are not logged in"}),401

#endpoint for viewing sevices
# @app.route('/service_list/<id>')
@api_view(['GET'])
def list(request,id):
    
    # if 'email' in session:
        data = conn.execute(f"select * from Services");  
    
        records = []
        name=""
        for row in data:
            record = {}
            record["ID"] = row[0]
            record["SERVICE_NAME"] = row[1]
            record["START_TIME"] = row[2]
            record["END_TIME"] = str(row[3])
            # record["Employee"] = str(row[4])
            employee = str(row[4])
            emp_data = conn.execute("select NAME from Employees where ID='"+employee+"'")
            print(emp_data)
            for each in emp_data:
                name = each[0]
            record["Employee"] = name
            record["empid"] = row[4]
        
        
            records.append(record)
        print(records)
        return Response(records)

    # else:
    #     return jsonify({"result":"you are not logged in"}),401,{'ContentType':'application/json'}

# #endoint for updating service
# @app.route('/update_service/<eid>/<id>',methods=['PUT'])
@api_view(['PUT'])
def update_service(request,eid,id):
    # if 'email' in session:

        data = request.data
        print("data : ", data)
        service_name = data.get("service_name")
        START_TIME = data.get("start_time")
        END_TIME = data.get("end_time")

        conn.execute("UPDATE Services SET SERVICE_NAME= '"+service_name+"', START_TIME='"+START_TIME+"',END_TIME='"+END_TIME+"' WHERE ID = '"+str(id)+"' AND Employee_ID='"+str(eid)+"';")
        conn.commit()
        return Response({"result": "Services Updated successfully","status":200})
    # else:
    #     return jsonify({"result":"you are not logged in"}),401,{'ContentType':'application/json'}


#endpint for deleting service
# @app.route('/delete_service/<eid>/<id>',methods=['DELETE'])
@api_view(['DELETE'])
def delete_service(request,eid,id):
    conn.execute("DELETE FROM Services where ID='"+str(id)+"' AND Employee_ID='"+str(eid)+"'")
    conn.commit()
    return Response({"result": "Services Deleted successfully","status":200})

#view employees list endpoint
# @app.route('/view_employees',methods=['GET'])
@api_view(['GET'])
def viewlist(request):
    # if 'email' in session:
    
        data = conn.execute("select * from Employees where role_id in (1,4)")

        records = []
    
        for row in data:
            record = {}
            record["ID"] = row[0]
            record["NAME"] = row[1]
            record["EMAIL"] = row[2]
            record["role"] = row[4]

            records.append(record)
        return Response(records)
    # else:
    #     return jsonify({"result":"you are not logged in"}),401


@api_view(['DELETE'])
def delEmp(request,ref_id,role_id):
    print(ref_id,role_id)
    conn.execute(f"DELETE FROM Employees where ref_id={ref_id} AND role_id={role_id} ")
    conn.commit()
    return Response({"result": "Employee Deleted successfully","status":200})

@api_view(['DELETE'])
def delEmploye(request,id):
    conn.execute(f"DELETE FROM Employees where id={id}")
    conn.commit()
    return Response({"result": "Employee Deleted successfully","status":200})

@api_view(['POST'])
def updateEmp(request,role_id,ref_id):
    email = str(request.data.get("email"))
    print(email)
    conn.execute("update Employees set email= '"+email+f"'where ref_id={ref_id} and role_id={role_id}")
    conn.commit()
    return Response({"result": "Employee Updated successfully","status":200})

@api_view(['POST'])
def updateManager(request,id):
    email = str(request.data.get("updateemail"))
    name = str(request.data.get("updatename"))
    role = str(request.data.get("role"))
    conn.execute("update Employees set email= '"+email+"',name='"+name+"', role_id='"+role+f"' where id={id}")
    conn.commit()
    return Response({"result": "Employee Updated successfully","status":200})

@api_view(['GET'])
def managerDetail(request,id):
    data = conn.execute(f"select * from Employees where id = {id}")
    conn.commit()
    record = {}
    for row in data:   
        record["ID"] = row[0]
        record["NAME"] = row[1]
        record["EMAIL"] = row[2]
        record["role"] = row[4]
  
    return Response(record)
   


