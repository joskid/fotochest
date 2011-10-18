from django.http import HttpResponse
from django.core.paginator import Paginator, EmptyPage, PageNotAnInteger
from django.shortcuts import render, get_object_or_404
from django.views.decorators.csrf import csrf_exempt
from photo_manager.models import *
from django.contrib.auth.models import User
import os
from django.conf import settings
import random
from sorl.thumbnail import get_thumbnail

@csrf_exempt
def myFileHandler(request):
    if request.method == 'POST':
        # 150  150
        # 900 700
        for field_name in request.FILES:
            uploaded_file = request.FILES[field_name]
            
            # write the file into /tmp
            num1 = str(random.randint(0, 1000000))
            num2 = str(random.randint(1001, 9000000))
            
            ext = os.path.splitext(uploaded_file.name)[1]
            filename = str(num1 + num2) + ext
            album_used = Album.objects.get(pk=4)
            photo_new = Photo(title=filename, album=album_used)
            photo_new.file_name = filename
            photo_new.image = filename
            photo_new.description = "YO"
            this_user = User.objects.get(username="dstegelman")
            photo_new.user = this_user
            photo_new.save()
            destination_path = settings.PHOTO_DIRECTORY + '/%s' % (filename)   
            destination = open(destination_path, 'wb+')
            for chunk in uploaded_file.chunks():
                destination.write(chunk)
            destination.close()
                        
        # indicate that everything is OK for SWFUpload
        
        return HttpResponse("ok", mimetype="text/plain")

    else:
        # show the upload UI
        context = {'upload_dir': settings.PHOTO_DIRECTORY}
        context['domain_static'] = settings.DOMAIN_STATIC
        return render(request, 'upload.html', context)
        
def upload(request, album_slug):
    if request.method == 'POST':
        for field_name in request.FILES:
            uploaded_file = request.FILES[field_name]
    else:
        context = {'upload_dir': settings.PHOTO_DIRECTORY}
        context['domain_static'] = settings.DOMAIN_STATIC
        context['album_slug'] = album_slug
        return render(request, 'upload.html', context)
        

def album(request, user_name, album_slug):
    user = User.objects.get(username=user_name)
    context = {'author':user}
    # If it has child albums, show those, if not, show pictures.
    album = Album.objects.get(slug=album_slug)
    if album.has_child_albums() == True:
        # Show child albums
        albums = Album.objects.filter(parent_album=album)
        context['albums'] = albums
        return render(request, "smugmug/albums.html", context)
    else:
        photos = Photo.objects.filter(album__slug=album_slug, user=user)
        paginator = Paginator(photos, 12)
        page = request.GET.get('page', 1)
        try:
            context['nav_photos'] = paginator.page(page)
        except PageNotAnInteger:
            context['nav_photos'] = paginator.page(1)
        except EmptyPage:
            context['nav_photos'] = paginator.page(paginator.num_pages)
        return render(request, "smugmug/index.html", context)
    
def albums(request, user_name):
    user = User.objects.get(username=user_name)
    context = {'albums': Album.objects.filter(user=user, parent_album=None), 'author': user}
    return render(request, "smugmug/albums.html", context)
    
def child_albums(request, user_name, parent_album_slug):
    user = User.objects.get(username=user_name)
    parent_album = Album.objects.get(slug=parent_album_slug, user=user)
    albums = Album.objects.filter(parent_album=parent_album)
    context = {'albums':albums, 'author': user}
    return render(request, "smugmug/albums.html", context)
        
def user_stream(request, user_name):
    user = User.objects.get(username=user_name)
    photos = Photo.objects.filter(user=user)
    paginator = Paginator(photos, 12)
    page = request.GET.get('page', 1)
    context = {'author': user}
    try:
        context['photos'] = paginator.page(page)
    except PageNotAnInteger:
        context['photos'] = paginator.page(1)
    except EmptyPage:
        context['photos'] = paginator.page(paginator.num_pages)
    return render(request, "smugmug/stream.html", context)

    
def homepage(request):
    
    context = {'photos': Photo.objects.all()[:20]}
    return render(request, "galleria/stream.html", context)
    

def photo(request, user_name, album_slug, photo_slug):
    user = User.objects.get(username=user_name)
    photo = get_object_or_404(Photo, slug=photo_slug, album__slug=album_slug)
    photos = Photo.objects.filter(album__slug=album_slug, user=user)
    paginator = Paginator(photos, 12)
    page = request.GET.get('page', 1)
    context = {'author': user}
    try:
        context['nav_photos'] = paginator.page(page)
    except PageNotAnInteger:
        context['nav_photos'] = paginator.page(1)
    except EmptyPage:
        context['nav_photos'] = paginator.page(paginator.num_pages)
    context['photo_id'] = photo.id
    return render(request, "smugmug/index.html", context)
'''
homepage
slideshow
paginated home page or page of photos
view a single photo
view all albums paginated
vail an album also paginated

download a photo

'''