from django.shortcuts import render , get_object_or_404,HttpResponseRedirect
from django.http import HttpResponse
from .models import *
from django.contrib.auth import get_user
from django import template
from django.utils import timezone

# Create your views here.
# Auto load file on templates

def index(request):
    if request.method == 'POST':
        Destination = request.POST['Destination']
        CheckInDate = request.POST['Check In Date']
        CheckOutDate = request.POST['Check Out Date']
        PriceLimit = request.POST['Price Limit']

        Phong_cho_thue.objects.raw('SET SQL_SAFE_UPDATES = 0')
        Phong_cho_thue.objects.raw("update polls_phong_cho_thue set ngay_bat_dau = NULL,"
                                   "ngay_ket_thuc =NULL where ngay_ket_thuc = '{}'".format(timezone.now().date()))

        sql="SELECT * FROM polls_phong_cho_thue where ngay_bat_dau and ngay_ket_thuc not between '{}' and '{}' " \
            " and gia_phong >={} and thanh_pho = '{}'".format(CheckInDate,CheckOutDate,float(PriceLimit),Destination)
        q =Phong_cho_thue.objects.raw(sql)
        noiden = Phong_cho_thue.objects.values('Thanh_pho').distinct()
        return render(request,'polls/services.html',{"object":q,'noiden':noiden})
    else:
        q=Phong_cho_thue.objects.all().order_by('id')[::-1][0:8]
        noiden = Phong_cho_thue.objects.values('Thanh_pho').distinct()
        return render(request,"polls/index.html",{"object":q,"noiden":noiden})
def about(request):
    return render(request, "polls/About.html")
def blog(request):
    return render(request, "polls/blog.html")
def contact(request):
    if request.method == "POST":
        First_name = request.POST["First Name"]
        Last_name = request.POST["Last Name"]
        Email = request.POST["Email"]
        Phong_number = request.POST["Phone Number"]
        Message = request.POST["Message"]
        Phan_hoi(First_name=First_name,Last_name=Last_name,Email=Email,Phong_number=Phong_number,Message=Message).save()
        return HttpResponseRedirect("/")
    else:
        return render(request, "polls/contact.html")
def services(request):
    c = get_user(request)
    print(c.get_username())
    if request.method == 'POST':
        Destination = request.POST['Destination']
        CheckInDate = request.POST['Check In Date']
        CheckOutDate = request.POST['Check Out Date']
        PriceLimit = request.POST['Price Limit']

        Phong_cho_thue.objects.raw('SET SQL_SAFE_UPDATES = 0')
        Phong_cho_thue.objects.raw("update polls_phong_cho_thue set ngay_bat_dau = NULL,"
                                   "ngay_ket_thuc =NULL where ngay_ket_thuc = '{}'".format(timezone.now().date()))

        sql = "SELECT * FROM polls_phong_cho_thue where (ngay_bat_dau and ngay_ket_thuc not between '{}' and '{}' " \
              " or (ngay_bat_dau is null and ngay_ket_thuc is null)) and gia_phong >={} and thanh_pho = '{}'"\
            .format(CheckInDate, CheckOutDate, float(PriceLimit),Destination)
        print(sql)
        q = Phong_cho_thue.objects.raw(sql)
        noiden = Phong_cho_thue.objects.values('Thanh_pho').distinct()
        return render(request, 'polls/services.html', {"object": q, 'noiden': noiden})
        return render(request,'polls/services.html',{"object":q})
    else:
        q = Phong_cho_thue.objects.all().order_by('id')[::-1]
        noiden = Phong_cho_thue.objects.values('Thanh_pho').distinct()
        return render(request,'polls/services.html',{"object":q,"noiden":noiden})
def services_search(request,id):
    if request.method == 'POST':
        Ten_khach_hang = request.POST['Name']
        Nam_sinh = request.POST['Year Of Birth']
        Email = request.POST['Email']
        Sdt = request.POST['Phone Number']
        ID_phong = id
        So_CMND = request.POST['Identity Number']
        Ngay_bat_dau = request.POST['Check In Date']
        Ngay_ket_thuc = request.POST['Check Out Date']
        Ghi_chu = request.POST['Note']
        Khach_hang(Ten_khach_hang=Ten_khach_hang,Nam_sinh=Nam_sinh,Email=Email,Sdt=Sdt,ID_phong=ID_phong,So_CMND=So_CMND,
                   Ngay_bat_dau=Ngay_bat_dau,Ngay_ket_thuc=Ngay_ket_thuc,Ghi_chu=Ghi_chu).save()
        return HttpResponseRedirect("/")
    else:
        q = Phong_cho_thue.objects.get(pk=id)
        return render(request,'polls/room.html',{"object":q})
