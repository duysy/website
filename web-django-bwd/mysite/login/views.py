from django.contrib.auth import authenticate
from django.contrib.auth import login as Login
from django.contrib.auth import logout as Logout
from django.shortcuts import render,HttpResponse,HttpResponseRedirect
from django.contrib.auth.models import User ,UserManager
from django.urls import path



# Create your views here.
linkmanagement='/management/index/'
def login(request):
    if request.method == 'POST':
        Username = request.POST["Username"]
        Password= request.POST["Password"]
        user = authenticate(username=Username,password=Password)
        if user is None :
            return HttpResponseRedirect('/login/register/', )
        else:
            Login(request,user)
            return HttpResponseRedirect(linkmanagement)
    else:
        return render(request,'login/Login.html',)

def register(request):
    if request.method == 'POST':
        Username = request.POST["Username"]
        Password = request.POST["Password"]
        Email = request.POST["Email"]
        print(Username)
        print(Password)
        print(Email)
        user = User.objects.create_user(Username, Email, Password)
        user.save()
        return HttpResponseRedirect(linkmanagement)
    else:
        return render(request, 'login/Register.html',)
def logout(request):
    Logout(request)
    return HttpResponseRedirect("/login/")




