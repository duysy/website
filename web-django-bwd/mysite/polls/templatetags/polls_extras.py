from django import template
from random import randint
from polls.models import *
register = template.Library()

@register.simple_tag
def get_modules_Chu_cho_thue(id):
    user = Chu_cho_thue.objects.get(pk=id)
    return str(user.Dia_chi)
#Lay name mot ten phong trong phong cho thue
@register.simple_tag
def get_modele_Phong_cho_thue(id):
    phong=Phong_cho_thue.objects.get(pk=id)
    return str(phong.So_ten_phong)