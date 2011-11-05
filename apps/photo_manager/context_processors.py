from locations.models import *
from photo_manager.models import *


def theme_files(request):
    context = {}
    context['THEME_URL'] = "http://localhost:8000/static/photo_manager/themes/default/"
    
    return context

def locations_albums(request):
    context = {}
    context['form_albums'] = Album.objects.all()
    context['form_locations'] = Location.objects.all()
    
    return context
    
    