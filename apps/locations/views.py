from django.shortcuts import render, get_object_or_404, redirect
from locations.models import *
from photo_manager.models import *
from profiles.models import *
from django.core.paginator import Paginator, EmptyPage, PageNotAnInteger
from locations.forms import *
from django.contrib.auth.models import User

def locations(request, username=None):
    context = {}
    
    if username:
        # OKay, get All locations associated with this user.
        
        context['locations'] = get_locations_for_user(username)
        context['current_user'] = User.objects.get(username=username)
        context['user_page'] = '1'
    else:
        context['locations'] = Location.objects.all()
    if request.POST:
        form = LocationForm(request.POST)
        if form.is_valid():
            location = form.save()
            if username:
                redirect("locations.views.locations", username=username)
            else:
                redirect("locations")
    else:
        context['location_form'] = LocationForm()
    
    return render(request, "map.html", context)
    
    
def location(request, location_slug, username=None):
    location = get_object_or_404(Location, slug=location_slug)
    # Get location object, now get more location objects where location.city = location.city?
    # how do we know if we are asking for city, state or country?  Should we have that specified?
    context = {}
    if username:
        photos = Photo.objects.filter(location=location, user__username=username)
        context['current_user'] = User.objects.get(username=username)
        context['user_page'] = '1'
    else:
        photos = Photo.objects.filter(location=location)
    paginator = Paginator(photos, 12)

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
    