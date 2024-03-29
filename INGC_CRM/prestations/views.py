from django.shortcuts import render
from django.http import Http404
from django.http import JsonResponse
from django.http import HttpResponse
from django.views.decorators.csrf import csrf_exempt
from rest_framework.parsers import JSONParser
import json
from rest_framework.reverse import reverse
from rest_framework.decorators import api_view
from rest_framework.response import Response
from rest_framework import status, renderers
from rest_framework.views import APIView
from rest_framework import mixins
from rest_framework import generics
from rest_framework import permissions

from .permissions import IsOwnerOrReadOnly
from .serializers import prestationSerializer1, PrestationSerializer, UserSerializer
from datetime import datetime
from .models import Client, Employe, Prestation, NewUser
from django.conf import settings
from django.contrib.auth import get_user_model
import pytz



User = get_user_model()


# Create your views here.

def home(request):
    client = Client.objects.all()
    employe = Employe.objects.all()
    prestation = Prestation.objects.all()
    context={'clients':client, 'employes':employe, 'prestations':prestation}
    return render(request,'acceuil.html',context)


def prestation(request):
    prestation = Prestation.objects.all()
    context ={'prestations':prestation}
    return render(request,'prestations/prestations.html',context)


@api_view(['GET'])
def prestationOverview(request):
    api_url = {
        'List':'prestationAPI-list/',
        'Detail View':'prestationAPI-detail/<str:pk>/',
        'Create': 'addPrestation/',
        'Update':'updatePrestation/<str:pk>/',
        'Delete': 'deletePrestation/<str:pk>/',
    }
    return Response(api_url)


@api_view(['GET'])
def prestationList(request):
    prestations = Prestation.objects.all()
    # print("debug"+ str(prestations[0].ref_employe))
    serializer = prestationSerializer1(prestations, many=True)
    return Response(serializer.data)


@api_view(['GET'])
def prestationDetail(request, pk):
    prestations = Prestation.objects.get(id=pk)
    serializer = prestationSerializer1(prestations, many=False)
    return Response(serializer.data)


@api_view(['POST'])
def addPrestation(request):
    start_date = request.data["heureArrivee"]
    end_date = request.data["heureDepart"]
    print(start_date,end_date)
    newpresatation =  Prestation.objects.create(
            nomPrestation =  request.data["nomPrestation"],
            heureArrivee =  start_date ,
            heureDepart =  end_date,
            ref_employe = Employe.objects.get( id =  request.data["ref_employe"]),
            ref_client = Client.objects.get( id = request.data["ref_client"]),
            commentaire =  request.data["commentaire"],
            clientcommentaire = request.data["remarque_client"],
            status = "Not Started Yet",
            create_by = User.objects.get(email="scaleinfinite@gmail.com"),
        )
    newpresatation.save()
    serializer = prestationSerializer1(newpresatation)
    # if serializer.is_valid():
    #     serializer.save()
    return Response(serializer.data)


@api_view(['POST'])
def UpdatePrestation(request, pk):
    prestations = Prestation.objects.get(id=pk)
    prestations.nomPrestation = request.data["nomPrestation"]
    prestations.heureArrivee = request.data["heureArrivee"]
    prestations.heureDepart = request.data["heureDepart"]
    if(prestations.ref_employe.id != int(request.data["ref_employe"]) or prestations.ref_client.id != int(request.data["ref_client"])):
        prestations.status = "Not Started Yet"
        prestations.checked_in = False
        prestations.checkin_time = prestations.checkout_time =  None
    
    prestations.ref_employe = Employe.objects.get( id =  request.data["ref_employe"])
    prestations.ref_client = Client.objects.get( id = request.data["ref_client"])
    prestations.commentaire = request.data["commentaire"]
    prestations.clientcommentaire = request.data["remarque_client"]
    prestations.save()
    serializer = prestationSerializer1(prestations)
    #serializer = PrestationSerializer(instance=prestations,data=request.data)
    # if serializer.is_valid():
    #     serializer.save()

    return Response(serializer.data)


@api_view(['DELETE'])
def DeletePrestation(request, pk):
    prestations = Prestation.objects.get(id=pk)
    prestations.delete()
    return Response("Prestation succesfully delete!")

@api_view(['POST'])
def Employee_checkin(request,pk):
    prestations = Prestation.objects.get(id=pk)
    prestations.checked_in = True
    prestations.checkin_time = request.data["timestamp"]
    prestations.status = "On-Going"
    prestations.save()
    res= json.dumps({"success":"Employee Checked in Successfully","checkin":prestations.checkin_time,"status":prestations.status})
    return Response(res)

@api_view(['POST'])
def Employee_checkout(request,pk):
    prestations = Prestation.objects.get(id=pk)
    if(prestations.checked_in):
        prestations.checked_in = False
        prestations.checkout_time = request.data["timestamp"]
        prestations.status = "Pending Validation"
        prestations.save()
        res= json.dumps({"success":"  Checked Out Successfully","checkout":prestations.checkout_time,"status":prestations.status})
        return Response(res)
    else:
        return Response("Please Check-in First")

@api_view(['POST'])
def Client_Feedback(request,pk):
    prestations = Prestation.objects.get(id=pk)
    prestations.clientcommentaire = request.data["clientcommentaire"]
    prestations.status = "Client Validated"
    prestations.save()
    serializer = prestationSerializer1(prestations)
    return Response(serializer.data)

@api_view(['POST'])
def Manager_validate(request,pk):
    prestations = Prestation.objects.get(id=pk)
    prestations.status = "Validated and Complete"
    prestations.save()
    serializer = prestationSerializer1(prestations)
    return Response(serializer.data)




@api_view(['POST'])
def Employee_Feedback(request,pk):
    prestations = Prestation.objects.get(id=pk)
    if(prestations.checked_in): 
        prestations.commentaire = request.data["commentaire"]
        prestations.checked_in = False
        prestations.checkout_time = request.data["timestamp"]
        prestations.status = "Pending Validation"
        prestations.save()
        serializer = prestationSerializer1(prestations)
        return Response(serializer.data)
    else:
        return Response("Please Check-in First")

@api_view(['POST'])
def Restart_prestation(request,pk):
    prestations = Prestation.objects.get(id=pk)
    try:
        prestations.clientcommentaire = request.data["clientcommentaire"]
        prestations.status = "Disputed"
    except KeyError:
        prestations.status = "Not Started Yet"
        prestations.checkin_time = prestations.checkout_time =  None
    prestations.checked_in = False
    prestations.save()
    serializer = prestationSerializer1(prestations)
    return Response(serializer.data)


# nouvelle version commence à partir de là


@api_view(['GET'])
def api_root(request, format= None):
    return Response({
        'users': reverse('users-list', request=request, format=format),
        'prestations': reverse('prestations-list', request=request, format=format),
    })


class UserList(generics.ListAPIView):
    queryset = User.objects.all()
    serializer_class = UserSerializer


class UserDetail(generics.RetrieveAPIView):
    queryset = User.objects.all()
    serializer_class = UserSerializer


class PrestationList(generics.ListCreateAPIView):
    queryset = Prestation.objects.all()
    serializer_class = PrestationSerializer
    permission_classes = [permissions.IsAuthenticatedOrReadOnly]

    def perform_create(self, serializer):
        serializer.save(create_by=self.request.user)


class PrestationDetail(generics.RetrieveUpdateDestroyAPIView):
    queryset = Prestation.objects.all()
    serializer_class = PrestationSerializer
    permission_classes = [permissions.IsAuthenticatedOrReadOnly, IsOwnerOrReadOnly]



