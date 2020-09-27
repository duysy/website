from django.shortcuts import render,HttpResponse,HttpResponseRedirect
from polls.models import *
from django.contrib.auth.models import User
from django.contrib.auth import get_user
from django.core.files.storage import FileSystemStorage
from django.utils import timezone


# Create your views here.
# Auto load file on templates
link='./management/static/management/img-user-management'
link_hotel ='./management/static/management/img-hotel'


def index(request):
    if request.user.is_authenticated:
        try:
            user = Chu_cho_thue.objects.get(pk=get_user(request).get_username())
            phong = user.phong_cho_thue_set.all()

            sql = "SELECT * FROM `django-web`.polls_khach_hang,`django-web`.polls_chu_cho_thue,`django-web`.polls_phong_cho_thue where" \
                  " polls_khach_hang.ID_phong = polls_phong_cho_thue.id and polls_phong_cho_thue.phong_id =polls_chu_cho_thue.User and " \
                  "polls_khach_hang.Ngay_bat_dau is not null;"

            cus = Khach_hang.objects.raw(sql)
            return render(request, 'management/index.html', {"phong": phong,"cus":cus})
        except:
            return render(request, 'management/index.html')
    else:
        return HttpResponseRedirect('/login/')


def profile(request):
    try:
        if request.user.is_authenticated:
            if request.method == 'POST':
                user = get_user(request).get_username()
                Ho_va_ten = request.POST['Full name']
                Dia_chi = request.POST['Address']
                Thanh_pho = request.POST['City']
                So_CMND = request.POST['Id number']
                file= request.FILES['Upload ID card']
                fs=FileSystemStorage(location=link)
                fs.save(file.name,file)
                print(file.name)
                Chu_cho_thue(User=user, Ho_va_ten=Ho_va_ten, Dia_chi=Dia_chi,
                                 Thanh_pho=Thanh_pho, So_CMND=So_CMND,Link_CMND=str(file.name)).save()

                return HttpResponseRedirect('/management/index/')
            else:
                return render(request, 'management/profile.html')
        else:
            return render(request, 'login/Login.html')
    except:
        return render(request, 'management/profile.html')
def addpost(request):
    if request.user.is_authenticated:
        if request.method == 'POST':
            Roomname=request.POST['Room name']
            NameHotel = request.POST['Name Hotel']
            AddressHotel = request.POST['Address Hotel']
            City = request.POST['City']
            Price=request.POST['Price']
            Rentaltype=request.POST['Rental type']
            Kindofroom=request.POST['Kind of room']
            file1=request.FILES['file1']
            file2=request.FILES['file2']
            file3=request.FILES['file3']
            Bathroom=int(request.POST['Bathroom'])
            Bed=int(request.POST['Bed'])
            Amountofpeople=int(request.POST['Amount of people'])
            Detail = request.POST['Detail']

            user = Chu_cho_thue.objects.get(pk=get_user(request).get_username())
            print(user.User)

            post = Phong_cho_thue(phong=user,So_ten_phong=Roomname,Loai_phong=Kindofroom,Loai_cho_thue=Rentaltype
             ,Chi_tiet=Detail,Gia_phong=Price,Phong_tam=Bathroom,So_giuong=Bed,So_nguoi=Amountofpeople,Ngay_dang=timezone.now(),
                                  Ten_khach_san= NameHotel,Dia_chi=AddressHotel,Thanh_pho=City)
            post.save()
            Link_anh(link_anh_phong =post,Link=file1.name).save()
            Link_anh(link_anh_phong =post,Link=file2.name).save()
            Link_anh(link_anh_phong =post,Link=file3.name).save()

            fs = FileSystemStorage(location=link_hotel)
            fs.save(file1.name, file1)
            fs.save(file2.name, file2)
            fs.save(file3.name, file3)
            print(Roomname)
            print(Rentaltype)
            print(Rentaltype)
            print(Bathroom)
            print(Bed)
            print(Detail)
            print(file1.name)
            print(file2.name)
            print(file3.name)
            return HttpResponseRedirect("/management/index")
        else:
            return render(request, 'management/index.html')
    else:
        return render(request, 'login/Login.html')


# class Link_anh(models.Model):
#     link_anh=models.ForeignKey(Phong_cho_thue,on_delete=models.CASCADE)
#     Link_anh=models.CharField(max_length=300)
def customers(request):
    user = Chu_cho_thue.objects.get(pk=get_user(request).get_username())
    phong = user.phong_cho_thue_set.all()
    sql="SELECT * FROM `django-web`.polls_khach_hang,`django-web`.polls_chu_cho_thue,`django-web`.polls_phong_cho_thue where" \
        " polls_khach_hang.ID_phong = polls_phong_cho_thue.id and polls_phong_cho_thue.phong_id =polls_chu_cho_thue.User and " \
        "polls_khach_hang.Ngay_bat_dau is not null;"

    cus = Khach_hang.objects.raw(sql)
    return render(request,"management/customers.html",{"customers":cus,"phong":phong})
def comments(request):
    user = Chu_cho_thue.objects.get(pk=get_user(request).get_username())
    object = user.phong_cho_thue_set.all().order_by('id')[::-1]
    return render(request,"management/comments.html",{"object":object})