from django.shortcuts import redirect, render   
from django.conf import settings
from django.contrib.auth.forms import *
from profiles.forms import *
from django.contrib.auth import authenticate, login
from django.contrib.auth.models import User


def redirect_home(request):
    
    if settings.ENABLE_MULTI_USER:
        if request.user.is_authenticated:
            username = request.user.username
            return redirect('photo_manager.views.homepage', username=username)
    else:
        return redirect('photo_manager.views.homepage')
        
def register_part_two(request, username):
    context = {}
    if request.method == "POST":
        form = ProfileForm(request.POST)
        if form.is_valid():
            user = User.objects.get(username=username)
            user.first_name = form.cleaned_data['first_name']
            user.last_name = form.cleaned_data['last_name']
            user.email = form.cleaned_data['email']
            user.save()
            return redirect('photo_manager.views.homepage', username=user.username)
    else:
        context['form'] = ProfileForm()
    
    return render(request, "registration_part_two.html", context)
        
def register(request):
    context = {}
    if request.method == "POST":
        form = UserCreationForm(request.POST)
        if form.is_valid():
            user = form.save()
            return redirect('profiles.views.register_part_two', username=user.username)
    else:
        context['form'] = UserCreationForm()

    return render(request, "registration.html", context)