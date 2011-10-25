from django.shortcuts import render, get_object_or_404, redirect
from locations.models import *
from photo_manager.models import *
from django.core.paginator import Paginator, EmptyPage, PageNotAnInteger
from locations.forms import *

def locations(request):
    context = {}
    if request.POST:
        form = LocationForm(request.POST)
        if form.is_valid():
            location = form.save()
            redirect("locations")
    else:
        context['location_form'] = LocationForm()
    context['locations'] = Location.objects.all()
    return render(request, "map.html", context)
    
    
def location(request, location_slug):
    location = get_object_or_404(Location, slug=location_slug)
    photos = Photo.objects.filter(location=location)
    paginator = Paginator(photos, 12)
    context = {}
    page = request.GET.get('page', 1)
    context['location_view'] = True
    context['location_slug'] = location_slug
    try:
        context['photos'] = paginator.page(page)
    except PageNotAnInteger:
        context['photos'] = paginator.page(1)
    except EmptyPage:
        context['photos'] = paginator.page(paginator.num_pages)
    return render(request, "index.html", context)
    