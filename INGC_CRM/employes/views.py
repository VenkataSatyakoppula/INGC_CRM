from django.shortcuts import render
from django.http import HttpResponse
from django.contrib.auth import authenticate
from employes.models import Employe
from clients.models import Client
from prestations.models import Prestation
from prestations.serializers import prestationSerializer1
from rest_framework.views import APIView
from rest_framework.decorators import api_view
from rest_framework.response import Response
from rest_framework.generics import GenericAPIView
from rest_framework import status
from .serializers import employeSerializer2, employeSerializer1, EmployeLoginSerializer
import json

# Create your views here.


def homeEmploye(request):
    employe = Employe.objects.all()
    context = {'employes': employe}
    return render(request, 'employes/employes.html', context)


class LoginEmploye(GenericAPIView):
    serializer_class = EmployeLoginSerializer

    def post(self, request):
        email = request.data.get('emailEmploye', None)
        mdp = request.data.get('mdpEmploye', None)

        user = authenticate(username=email, password=mdp)

        if user:
            serializer=self.serializer_class(user)

            return Response(serializer.data, status=status.HTTP_200_OK)

        return Response({'message':"Invalid credentials, try again"}, status=status.HTTP_401_UNAUTHORIZED)


@api_view(['GET'])
def employeList(request):
    employes = Employe.objects.all()
    serializer = employeSerializer1(employes, many=True)
    return Response(serializer.data)


@api_view(['GET'])
def employeDetail(request, pk):
    employes = Employe.objects.get(id=pk)
    serializer = employeSerializer1(employes, many=False)
    return Response(serializer.data)


@api_view(['POST'])
def addEmploye(request):
    serializer = employeSerializer2(data=request.data)
    if(Client.objects.filter(emailClient=request.data["emailEmploye"]).exists() or Employe.objects.filter(emailEmploye=request.data["emailEmploye"]).exists()):
        return Response(json.dumps({"status":"email already exists"}))
    if serializer.is_valid():
        serializer.save()
    return Response(serializer.data)


@api_view(['POST'])
def UpdateEmploye(request, pk):
    employes = Employe.objects.get(id=pk)
    if((Client.objects.filter(emailClient=request.data["emailEmploye"]).exists() or Employe.objects.filter(emailEmploye=request.data["emailEmploye"]).exists()) and employes.emailEmploye != request.data["emailEmploye"]):
        return Response(json.dumps({"status":"email already exists"}))
    serializer = employeSerializer2(instance = employes,data=request.data)
    print(serializer.is_valid())
    if serializer.is_valid():
        serializer.save()
    return Response(serializer.data)


@api_view(['DELETE'])
def DeleteEmploye(request, pk):
    employes = Employe.objects.get(id=pk)
    employes.delete()
    return Response("Employe succesfully delete!")

@api_view(['GET'])
def EmployeeJobs(request,pk):
    employe = Employe.objects.get(id=pk)
    prestations = Prestation.objects.filter(ref_employe=employe)
    serializer = prestationSerializer1(prestations,many=True)
    return Response(serializer.data)

@api_view(['DELETE'])
def deleteEmployeeJobs(request,pk):
    employe = Employe.objects.get(id=pk)
    prestations = Prestation.objects.filter(ref_employe=employe)
    prestations.delete()
    return Response("employe Prestation succesfully deleted!")