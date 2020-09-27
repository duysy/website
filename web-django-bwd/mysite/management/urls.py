from django.urls import path

from . import views

app_name ="management"
urlpatterns = [
    # path('', views.management,name="management"),
    path('index/', views.index,name="index"),
    path('profile/', views.profile,name="profile"),
    path('addpost/', views.addpost,name="addpost"),
    path('customers/',views.customers,name="customers"),
    path('comments/',views.comments,name="comments")

]
