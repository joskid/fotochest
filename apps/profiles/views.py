from django.shortcuts import redirect
from django.conf import settings



def redirect_home(request):
    
    if settings.ENABLE_MULTI_USER:
        if request.user.is_authenticated:
            username = request.user.username
            return redirect('photo_manager.views.homepage', username=username)
    else:
        return redirect('photo_manager.views.homepage')
        