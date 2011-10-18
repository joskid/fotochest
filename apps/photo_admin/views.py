from django.shortcuts import render, get_object_or_404
from photo_manager.models import Photo, Album
from django.conf import settings
from sorl.thumbnail import get_thumbnail
from django.http import HttpResponse
from django.views.decorators.csrf import csrf_exempt
from django.contrib.auth.models import User
import os
import random

def dashboard(request):
    photos = Photo.objects.all()[:10]
    context = {'photos': photos}
    return render(request, "photo_admin/dashboard.html", context)
    
    
def albums(request):
    albums = Album.objects.all()[:10]
    context = {'albums': albums}
    return render(request, "photo_admin/albums.html", context)

def view_album(request, album_slug):
    photos = Photo.objects.filter(album__slug=album_slug)
    context = {'photos': photos}
    context['album_slug'] = album_slug
    return render(request, "photo_admin/single_album.html", context)
    
def create_album(request):
    
    return render(request, "photo_admin/modals/addAlbum.html", context)

@csrf_exempt
def upload(request, album_slug):
    if request.method == 'POST':
        for field_name in request.FILES:
            uploaded_file = request.FILES[field_name]
            # write the file into /tmp
            num1 = str(random.randint(0, 1000000))
            num2 = str(random.randint(1001, 9000000))
            
            ext = os.path.splitext(uploaded_file.name)[1]
            filename = str(num1 + num2) + ext
            photo = Photo(title=filename)
            album = get_object_or_404(Album, slug=album_slug)
            photo.album = album
            photo.description = ""
            photo.user = request.user
            photo.file_name = filename
            destination_path = settings.PHOTO_DIRECTORY + '/%s' % (filename)   
            destination = open(destination_path, 'wb+')
            for chunk in uploaded_file.chunks():
                destination.write(chunk)
            destination.close()
            photo.image = filename
            photo.save()
            
        # indicate that everything is OK for SWFUpload
        
        return HttpResponse("ok", mimetype="text/plain")
    else:
        context = {'upload_dir': settings.PHOTO_DIRECTORY}
        context['domain_static'] = settings.DOMAIN_STATIC
        context['album_slug'] = album_slug
        return render(request, 'photo_admin/upload.html', context)

def login(request):
    return render(request, 'photo_admin/login.html')