from django.http import HttpResponse
from django.core.paginator import Paginator, EmptyPage, PageNotAnInteger
from django.shortcuts import render, get_object_or_404, redirect
from django.views.decorators.csrf import csrf_exempt
from photo_manager.models import *
from locations.models import Location
from django.contrib.auth.models import User
import os
from django.conf import settings
import random
from sorl.thumbnail import get_thumbnail
from photo_manager.forms import *



# please work on album(s) [CHILD ALBUMS{ page.

def choose(request):
    return redirect('file_uploader', location_slug=request.GET.get('location'), album_slug=request.GET.get("album"))

#--------------------------------------------#
#
# photo_upload().  Tired as I write this.  the
# method should add photos to a specific location
# THIS NEEDS FIXING
#
#--------------------------------------------#
@csrf_exempt
def photo_upload(request, location_slug, album_slug):
    context = {}
    if request.method == 'POST':
        #"240x165"
        #1024x768"
        for field_name in request.FILES:
            uploaded_file = request.FILES[field_name]
            
            # write the file into /tmp
            num1 = str(random.randint(0, 1000000))
            num2 = str(random.randint(1001, 9000000))
            
            ext = os.path.splitext(uploaded_file.name)[1]
            filename = str(num1 + num2) + ext
            album_used = Album.objects.get(slug=album_slug)
            
            photo_new = Photo(title=filename, album=album_used)
            photo_new.file_name = filename
            # The line below needs to be changed.
            photo_new.image = "images/" + filename
            # Set location to default location
            photo_location = get_object_or_404(Location, slug=location_slug)
            photo_new.location = photo_location
            photo_new.description = "YO"
            this_user = User.objects.get(username="dstegelman")
            photo_new.user = this_user
            photo_new.save()
            destination_path = settings.PHOTO_DIRECTORY + '/%s' % (filename)   
            destination = open(destination_path, 'wb+')
            for chunk in uploaded_file.chunks():
                destination.write(chunk)
            destination.close()
            im = get_thumbnail(photo_new.image, '150x150', crop="center")
            im2 = get_thumbnail(photo_new.image, '1024x768')
            im3 = get_thumbnail(photo_new.image, '240x165')
            
        # indicate that everything is OK for SWFUpload
        
        return HttpResponse("ok", mimetype="text/plain")
        
    else:

        context['upload_dir'] = settings.PHOTO_DIRECTORY
        context['album_slug'] = album_slug
        context['location_slug'] = location_slug
        context['domain_static'] = settings.DOMAIN_STATIC    
        return render(request,'upload.html', context)
    
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
            album_used = Album.objects.get(pk=1)
            photo_new = Photo(title=filename, album=album_used)
            photo_new.file_name = filename
            # The line below needs to be changed.
            photo_new.image = "images/" + filename
            # Set location to default location
            photo_location = get_object_or_404(Location, default_location=True)
            photo_new.location = photo_location
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
    context['album_slug'] = album_slug
    # If it has child albums, show those, if not, show pictures.
    album = Album.objects.get(slug=album_slug)
    if album.has_child_albums() == True:
        # Show child albums
        albums = Album.objects.filter(parent_album=album)
        context['albums'] = albums
        
        return render(request, "albums.html", context)
    else:
        photos = Photo.objects.filter(album__slug=album_slug, user=user)
        paginator = Paginator(photos, 12)
        page = request.GET.get('page', 1)
        context['album_view'] = True
        try:
            context['photos'] = paginator.page(page)
        except PageNotAnInteger:
            context['photos'] = paginator.page(1)
        except EmptyPage:
            context['photos'] = paginator.page(paginator.num_pages)
        return render(request, "index.html", context)
    
def albums(request, user_name):
    user = User.objects.get(username=user_name)
    context = {'albums': Album.objects.filter(user=user, parent_album=None), 'author': user}
    if request.POST:
        form = AlbumForm(request.POST)
        if form.is_valid():
            album = form.save(commit=False)
            album.user = request.user
            album.save()
    else:
        context['album_form'] = AlbumForm()
    
    return render(request, "albums.html", context)
    
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
    return render(request, "index.html", context)

    
def homepage(request):
    
    photos = Photo.objects.all()
    paginator = Paginator(photos, 12)
    page = request.GET.get('page', 1)
    context = {}
    try:
        context['photos'] = paginator.page(page)
    except PageNotAnInteger:
        context['photos'] = paginator.page(1)
    except EmptyPage:
        context['photos'] = paginator.page(paginator.num_pages)
    return render(request, "index.html", context)
    

def photo(request, user_name, album_slug, photo_slug):
    user = User.objects.get(username=user_name)
    photo = get_object_or_404(Photo, slug=photo_slug, album__slug=album_slug)
    photos = Photo.objects.filter(album__slug=album_slug, user=user)
    paginator = Paginator(photos, 6)
    page = request.GET.get('page', 1)
    context = {'author': user}
    try:
        context['nav_photos'] = paginator.page(page)
    except PageNotAnInteger:
        context['nav_photos'] = paginator.page(1)
    except EmptyPage:
        context['nav_photos'] = paginator.page(paginator.num_pages)
    context['photo_id'] = photo.id
    context['photo'] = photo
    return render(request, "photo.html", context)
    
def slideshow(request, location_slug=None, album_slug=None):
    context = {}
    if location_slug:
        context['photos'] = Photo.objects.filter(location__slug=location_slug)
    if album_slug:
        context['photos'] = Photo.objects.filter(album__slug=album_slug)
    
    return render(request, "slideshow.html", context)
'''
homepage
slideshow
paginated home page or page of photos
view a single photo
view all albums paginated
vail an album also paginated

download a photo

'''