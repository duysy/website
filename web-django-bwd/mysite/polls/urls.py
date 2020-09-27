from django.urls import path


from . import views
app_name ="polls"
urlpatterns = [
    path('', views.index,name="index"),
    path('/about/', views.about, name="about"),
    path('/blog/', views.blog, name="blog"),
    path('/contact/', views.contact, name="contact"),
    path('/services/', views.services, name="services"),
    path('/services/<int:id>', views.services_search, name="services_search"),

]
