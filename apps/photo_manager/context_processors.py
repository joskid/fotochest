from locations.models import *
from photo_manager.models import *
from django.conf import settings

def theme_files(request):
    context = {}
    context['ENABLE_MULTI_USER'] = settings.ENABLE_MULTI_USER
    context['THEME_URL'] = "http://localhost:8000/static/photo_manager/themes/default/"
    
    return context

def locations_albums(request):
    context = {}
    context['form_locations'] = Location.objects.all()
    
    return context
    
    