from django.shortcuts import render, get_object_or_404
from fotoapp.models import *
from django.core.paginator import Paginator, EmptyPage, PageNotAnInteger

def album(request, album_slug):
    context = {}
    context['album'] = get_object_or_404(Album, slug=album_slug)
    
    return render(request, "fotoapp/album.html", context)


def albums(request):
    context = {}
    context['albums'] = Album.objects.published()
    return render(request, "fotoapp/albums.html", context)


def photo(request, photo_slug):
    context = {}
    context['photo'] = get_object_or_404(Photo, slug=photo_slug)
    return render(request, "fotoapp/photo.html", context)


def home(request):
    context = {}
    context['photos'] = Photo.objects.published()[:20]
    photos = Photo.objects.published()
    paginator = Paginator(photos, 20)
    page = request.GET.get('page', 1)
    try:
        context['photos'] = paginator.page(page)
    except PageNotAnInteger:
        context['photos'] = paginator.page(1)
    except EmptyPage:
        context['photos'] = paginator.page(paginator.num_pages)
    
    
    return render(request, "fotoapp/index.html", context)
