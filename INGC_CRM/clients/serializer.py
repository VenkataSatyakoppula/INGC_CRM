from rest_framework import serializers
from .models import Client


class clientSerializer2(serializers.ModelSerializer):
    class Meta:
        model = Client
        fields = ['id','prenomClient', 'nomClient', 'ageClient', 'emailClient',
                  'telClient', 'complementAdresseClient','rueClient', 'villeClient', 'cpClient']


class clientSerializer1(serializers.ModelSerializer):
    class Meta:
        model = Client
        fields = '__all__'


class clientSerializer3(serializers.ModelSerializer):
    class Meta:
        model = Client
        fields = ['prenomClient', 'nomClient', 'rueClient', 'villeClient', 'cpClient']