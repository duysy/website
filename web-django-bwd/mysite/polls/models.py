from django.db import models
from django.contrib.auth.models import User



# Create your models here.

class Chu_cho_thue(models.Model):
    User = models.CharField(primary_key=True,max_length=200)
    Ho_va_ten =models.CharField(max_length=200)
    Dia_chi=models.CharField(max_length=200)
    Thanh_pho=models.CharField(max_length=100)
    So_CMND=models.CharField(unique=True,max_length=50)
    Link_CMND=models.CharField(max_length=500)

class Phong_cho_thue(models.Model):
    phong=models.ForeignKey(Chu_cho_thue,on_delete=models.CASCADE)
    So_ten_phong=models.CharField(max_length=100)
    Loai_phong=models.CharField(max_length=100)
    Loai_cho_thue=models.CharField(max_length=100)
    Chi_tiet = models.TextField(null=True)
    Ngay_bat_dau=models.DateField(null=True)
    Ngay_ket_thuc=models.DateField(null=True)
    Gia_phong=models.FloatField(blank=True)
    Hop_dong=models.TextField(null=False)
    Phong_tam=models.IntegerField(null=True)
    So_giuong = models.IntegerField(null=True)
    So_nguoi = models.IntegerField(null=True)
    Ngay_dang = models.DateField(null=True)
    Ten_khach_san = models.CharField(max_length=200)
    Dia_chi = models.CharField(max_length=200)
    Thanh_pho = models.CharField(max_length=100)


class Link_anh(models.Model):
    link_anh_phong=models.ForeignKey(Phong_cho_thue,on_delete=models.CASCADE)
    Link=models.CharField(max_length=300,blank=True)

class Binh_luan(models.Model):
    binhluan = models.ForeignKey(Phong_cho_thue,on_delete=models.CASCADE)
    name = models.CharField(max_length=200)
    So_sao = models.CharField(max_length=200)
    Text_binh_luan = models.TextField()
    Thoi_gian = models.DateTimeField()
class Khach_hang(models.Model):
    Ten_khach_hang=models.CharField(max_length=200)
    Nam_sinh=models.IntegerField()
    Email=models.EmailField()
    Sdt= models.CharField(max_length=50)
    ID_phong=models.CharField(max_length=100)
    So_CMND=models.CharField(max_length=50,primary_key=True)
    Ngay_bat_dau=models.DateField()
    Ngay_ket_thuc=models.DateField()
    Ghi_chu=models.CharField(max_length=300)
class Phan_hoi(models.Model):
    First_name = models.CharField(max_length=100)
    Last_name = models.CharField(max_length=100)
    Email = models.EmailField()
    Phong_number = models.CharField(max_length=100)
    Message = models.TextField()



