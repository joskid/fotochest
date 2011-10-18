from django.db import models
from django.contrib.auth.models import User
from nutsbolts.utils.slugs import unique_slugify
import os
from django.conf import settings

class Album(models.Model):
    title = models.CharField(max_length=250)
    slug = models.SlugField(editable=False, blank=True)
    description = models.TextField()
    date_created = models.DateTimeField(auto_now=True, auto_now_add=True)
    parent_album = models.ForeignKey('self', blank=True, null=True)
    album_cover = models.ImageField(upload_to="cover_art/", max_length=400, blank=True, null=True)
    user = models.ForeignKey(User)
    
    def __unicode__(self):
        return self.title

    def save(self):
        unique_slugify(self, self.title)
        super(Album, self).save()
        
    def get_album_cover(self):
        this_photo = ""
        try:
            photos = Photo.objects.filter(album=self)[:1]
            for photo in photos:
                this_photo = photo
        except:
            pass
            this_photo = ""
        return this_photo
    
    def has_child_albums(self):
        album_count = Album.objects.filter(parent_album=self).count()
        if album_count == 0:
            return False
        else:
            return True

    
    @models.permalink
    def get_absolute_url(self):
        return ('photo_manager.views.album', (), {'album_slug': self.slug, 'user_name': self.user.username})

def create_album_dir(album_slug):
    parent_path = settings.PHOTO_DIRECTORY + "/albums"
    os.mkdir(parent_path + "/" + album_slug + "/")
    

class Photo(models.Model):
    title = models.CharField(max_length=250)
    slug = models.SlugField(editable=False, blank=True)
    file_name = models.CharField(max_length=400, editable=False)
    image = models.ImageField(upload_to=settings.PHOTO_DIRECTORY, max_length=400)
    description = models.TextField()
    date_uploaded = models.DateTimeField(auto_now=True, auto_now_add=True)
    album = models.ForeignKey(Album)
    user = models.ForeignKey(User)
    
    def __unicode__(self):
        return self.title
    
    def save(self):
        unique_slugify(self, self.title)
        super(Photo, self).save()
    
    
    @models.permalink
    def get_absolute_url(self):
        return ('photo_manager.views.photo', (), {'photo_slug': self.slug, 'album_slug': self.album.slug, 'user_name': self.user.username})

    