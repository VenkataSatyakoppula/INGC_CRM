# Generated by Django 4.1.3 on 2022-12-04 11:25

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('prestations', '0007_alter_prestation_heurearrivee_and_more'),
    ]

    operations = [
        migrations.AlterField(
            model_name='prestation',
            name='heureArrivee',
            field=models.DateTimeField(auto_now_add=True, null=True),
        ),
        migrations.AlterField(
            model_name='prestation',
            name='heureDepart',
            field=models.DateTimeField(auto_now_add=True, null=True),
        ),
    ]
