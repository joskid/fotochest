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
from django.conf import settings


# please work on album(s) [CHILD ALBUMS{ page.

def choose(request):
    return redirect('file_uploader', username=request.user.username, location_slug=request.GET.get('location'), album_slug=request.GET.get("album"))

#--------------------------------------------#
#
# photo_upload().  Tired as I write this.  the
# method should add photos to a specific location
# THIS NEEDS FIXING
#
#--------------------------------------------#
@csrf_exempt
def photo_upload(request, username, location_slug, album_slug):
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
            photo_new.image = 'images/' + filename
            # Set location to default location
            photo_new.location = get_object_or_404(Location, slug=location_slug)
            #photo_new.location = photo_location
            #photo_new.description = "YO"
            # The script isn't sending a user object back in teh request...
            photo_new.user = User.objects.get(username=username)
            #photo_new.user = this_user
            photo_new.save()
            destination_path = settings.PHOTO_DIRECTORY + '/%s' % (filename)   
            destination = open(destination_path, 'wb+')
            for chunk in uploaded_file.chunks():
                destination.write(chunk)
            destination.close()
            #im = get_thumbnail(photo_new.image, '150x150', crop="center")
            #im2 = get_thumbnail(photo_new.image, '1024x768')
            #im3 = get_thumbnail(photo_new.image, '240x165')
            
        # indicate that everything is OK for SWFUpload
        
        return HttpResponse("ok", mimetype="text/plain")
        
    else:
        if request.user and request.user.username == username:
            user = User.objects.get(username=username)
            context['current_user'] = user
            context['user_page'] = '1'
            context['upload_dir'] = settings.PHOTO_DIRECTORY
            context['album_slug'] = album_slug
            context['location_slug'] = location_slug
            context['domain_static'] = settings.DOMAIN_STATIC    
            return render(request,'upload.html', context)
        else:
            return render(request, 'not_authorized.html')

def album(request, album_id, album_slug, username=None):
    context = {}
    if settings.ENABLE_MULTI_USER:    
        user = User.objects.get(username=username)
        context['current_user'] = user
        context['user_page'] = '1'
        
    context['album_slug'] = album_slug
    # If it has child albums, show those, if not, show pictures.
    album = get_object_or_404(Album, pk=album_id)
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
    
def albums(request, username=None):
    context = {}
    if settings.ENABLE_MULTI_USER:
        user = User.objects.get(username=username)
        context['current_user'] = user
        context['user_page'] = '1'
        albums = Album.objects.filter(user__username=username, parent_album=None)
    else:
        albums = Album.objects.filter(parent_album=None)
    context['albums'] = albums
    #context = {'author': user}
    if request.POST and request.user.is_authenticated():
        form = AlbumForm(request.POST)
        if form.is_valid():
            album = form.save(commit=False)
            album.user = request.user
            album.save()
    else:
        context['album_form'] = AlbumForm()
        if settings.ENABLE_MULTI_USER:
            context['parent_albums'] = Album.objects.filter(user__username=username)
        else:
            context['parent_albums'] = Album.objects.all()
            
    return render(request, "albums.html", context)
    
def child_albums(request, user_name, parent_album_slug):
    user = User.objects.get(username=user_name)
    parent_album = Album.objects.get(slug=parent_album_slug, user=user)
    albums = Album.objects.filter(parent_album=parent_album)
    context = {'albums':albums, 'author': user}
    return render(request, "smugmug/albums.html", context)
    
def homepage(request, username=None):
    context = {}
    if settings.ENABLE_MULTI_USER:

        if username:
            photos = Photo.objects.filter(user__username=username)
            context['user_page'] = '1'
            context['current_user'] = User.objects.get(username=username)
            context['form_albums'] = Album.objects.filter(user__username=username)
        else:
            context['user_page'] = '0'
            photos = Photo.objects.all()
            
    else:
        photos = Photo.objects.filter(user__username=username)
        context['form_albums'] = Album.objects.all()
        
    paginator = Paginator(photos, 12)
    page = request.GET.get('page', 1)
    
    try:
        context['photos'] = paginator.page(page)
    except PageNotAnInteger:
        context['photos'] = paginator.page(1)
    except EmptyPage:
        context['photos'] = paginator.page(paginator.num_pages)
    return render(request, "index.html", context)
    

def photo(request, photo_id, album_slug, photo_slug, username=None):
    context = {}
    if settings.ENABLE_MULTI_USER:
        if username:
            user = User.objects.get(username=username)
            photo = get_object_or_404(Photo, pk=photo_id)
            
            context['user_page'] = '1'
            context['current_user'] = user
    else:
        photo = get_object_or_404(Photo, pk=photo_id)
    
    photos = Photo.objects.filter(album__slug=album_slug, id__lt=photo_id)[:8]
    
    context['photo_id'] = photo.id
    context['photo'] = photo
    context['other_photos'] = photos
    context['photos_from_this_location'] = Photo.objects.filter(location=photo.location)[:4]
    return render(request, "photo.html", context)

def photo_fullscreen(request, photo_id, album_slug, photo_slug, username=None):
    context = {}
    context['photo'] = Photo.objects.get(pk=photo_id)
    
    
    return render(request, 'fullscreen.html', context)

    
def slideshow(request, location_slug=None, album_slug=None, username=None):
    context = {}
    if location_slug:
        context['photos'] = Photo.objects.filter(location__slug=location_slug)
        location = Location.objects.get(slug=location_slug)
        context['what_object'] = location
    if album_slug:
        context['photos'] = Photo.objects.filter(album__slug=album_slug)
        album = Album.objects.get(slug=album_slug)
        context['what_object'] = album.title
     
    
    return render(request, "slideshow.html", context)
    
    
### Forms
def edit_photo(request, photo_id=None, album_slug=None, username=None, photo_slug=None):
    context = {}
    context['current_user'] = User.objects.get(username=username)
    photo = Photo.objects.get(pk=photo_id)
    if request.user != photo.user:
        return render(request, 'not_authorized.html')
        
    if request.method == "POST":
        form = PhotoForm(request.POST, instance=photo)
        if form.is_valid():
            new_photo = form.save()
            
            return redirect(new_photo)
    else:        
        form = PhotoForm(instance=photo)
    context['form'] = form
    context['photo'] = photo
    
    return render(request, 'edit_photo.html', context)
    
def delete_photo(request, photo_id=None, album_slug=None, username=None, photo_slug=None):
    return render(request, 'edit_photo.html')

### Jobs

def run_thumb_job(request):
    photos = Photo.objects.filter(thumbs_created=False)[:3]
    for photo in photos:
        try:
            photo.make_thumbnails()
            photo.thumbs_created = True
            photo.save()
        except:
            photo.thumbs_created = False
            photo.save()
            return HttpResponse("Thumb Creation Failure", mimetype="text/plain")
        
    return HttpResponse("Thumbs Created", mimetype="text/plain")


def update_photo_title(request):
    if request.method == "POST":
        photo_title = request.POST.get("photo_title")
        photo_id = request.POST.get("photo_id")
        photo = Photo.objects.get(pk=photo_id)
        photo.title = photo_title
        photo.save()
        
    return HttpResponse("ok", mimetype="text/plain")
    

def update_album_title(request):
    if request.method == "POST":
        album_title = request.POST.get("album_title")
        album_id = request.POST.get("album_id")
        album = Album.objects.get(pk=album_id)
        album.title = album_title
        album.save()
    
    return HttpResponse("ok", mimetype="text/plain")
    
'''
homepage
slideshow
paginated home page or page of photos
view a single photo
view all albums paginated
vail an album also paginated

download a photo

'''