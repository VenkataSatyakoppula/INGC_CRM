# Generated by Django 4.1.3 on 2023-02-13 09:45

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('prestations', '0010_prestation_checked_in'),
    ]

    operations = [
        migrations.AddField(
            model_name='prestation',
            name='checkin_time',
            field=models.DateTimeField(null=True),
        ),
        migrations.AddField(
            model_name='prestation',
            name='checkout_time',
            field=models.DateTimeField(null=True),
        ),
    ]