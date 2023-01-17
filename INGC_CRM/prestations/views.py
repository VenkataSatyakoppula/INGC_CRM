from django.shortcuts import render
from django.http import Http404
from django.http import JsonResponse
from django.http import HttpResponse
from django.views.decorators.csrf import csrf_exempt
from rest_framework.parsers import JSONParser

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

from .models import Client, Employe, Prestation, NewUser
from django.conf import settings
from django.contrib.auth import get_user_model
from django.utils.dateparse import parse_datetime
from django.utils.timezone import is_aware, make_aware

def get_aware_datetime(date_str):
    ret = parse_datetime(date_str)
    if not is_aware(ret):
        ret = make_aware(ret)
    return ret

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
    start_date = get_aware_datetime(request.data["heureArrivee"])
    end_date = get_aware_datetime(request.data["heureDepart"])
    newpresatation =  Prestation.objects.create(
            nomPrestation =  request.data["nomPrestation"],
            heureArrivee =  start_date ,
            heureDepart =  end_date,
            ref_employe = Employe.objects.get( id =  request.data["ref_employe"]),
            ref_client = Client.objects.get( id = request.data["ref_client"]),
            commentaire =  request.data["commentaire"],
            clientcommentaire = request.data["remarque_client"],
            status = request.data["statut"],
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
    prestations.ref_employe = Employe.objects.get( id =  request.data["ref_employe"])
    prestations.ref_client = Client.objects.get( id = request.data["ref_client"])
    prestations.commentaire = request.data["commentaire"]
    prestations.clientcommentaire = request.data["remarque_client"]
    prestations.status = request.data["statut"]
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



