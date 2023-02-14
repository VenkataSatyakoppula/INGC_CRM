from django.shortcuts import render
from django.http import HttpResponse
from clients.models import Client
from employes.models import Employe
from prestations.models import Prestation
from prestations.serializers import prestationSerializer1
from rest_framework.decorators import api_view
from rest_framework.response import Response
from .serializer import clientSerializer2, clientSerializer1
import json

# Create your views here.

def homeClient(request):
    client = Client.objects.all()
    context = {'clients':client}
    return render(request,'clients/clients.html',context)

@api_view(['GET'])
def clientList(request):
    clients = Client.objects.all()
    serializer = clientSerializer1(clients, many=True)
    return Response(serializer.data)

@api_view(['GET'])
def clientDetail(request, pk):
    clients = Client.objects.get(id=pk)
    serializer = clientSerializer1(clients, many=False)
    return Response(serializer.data)

@api_view(['POST'])
def addClient(request):
    serializer = clientSerializer2(data=request.data)
    if(Client.objects.filter(emailClient=request.data["emailClient"]).exists() or Employe.objects.filter(emailEmploye=request.data["emailClient"]).exists() ):
        return Response(json.dumps({"status":"email already exists"})) 
    if serializer.is_valid():
        serializer.save()
    return Response(serializer.data)

@api_view(['POST'])
def UpdateClient(request, pk):
    clients = Client.objects.get(id=pk)
    if((Client.objects.filter(emailClient=request.data["emailClient"]).exists() or Employe.objects.filter(emailEmploye=request.data["emailClient"]).exists()) and clients.emailClient != request.data["emailClient"] ):
        return Response(json.dumps({"status":"email already exists"}))
    serializer = clientSerializer2(instance=clients,data=request.data)
    print(serializer.is_valid())
    if serializer.is_valid():
        serializer.save()

    return Response(serializer.data)

@api_view(['DELETE'])
def DeleteClient(request, pk):
    clients = Client.objects.get(id=pk)
    clients.delete()
    return Response("Client succesfully delete!")

@api_view(['GET'])
def ClientJobs(request,pk):
    if(Client.objects.filter(id=pk).exists()):
        client = Client.objects.get(id=pk)
        prestations = Prestation.objects.filter(ref_client=client)
        serializer = prestationSerializer1(prestations,many=True)
        return Response(serializer.data)  
    
    return Response(json.dumps({"status":"Account has been Deleted!"}))  

    

@api_view(['DELETE'])
def deleteClientJobs(request,pk):
    client = Client.objects.get(id=pk)
    prestations = Prestation.objects.filter(ref_client=client)
    prestations.delete()
    return Response("Client Prestation succesfully deleted!")

