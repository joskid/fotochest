from django.db import models
from django.contrib.auth.models import User
from nutsbolts.utils.slugs import unique_slugify
import os
from django.conf import settings
from locations.models import *
from sorl.thumbnail import get_thumbnail

class Album(models.Model):
    title = models.CharField(max_length=250)
    slug = models.SlugField(editable=False, blank=True)
    description = models.TextField(null=True, blank=True)
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
            return photos[0]
        except:
            # Try for first Child.
            try:
                albums = Album.objects.filter(parent_album=self)[:1]
                album = albums[0]
                photos = Photo.objects.filter(album=album)[:1]
                return photos[0]
                    
            except:
                # one final layer down
                try:
                    albums = Album.objects.filter(parent_album=self)[:1]
                    album = albums[0]
                    new_album = Album.objects.filter(parent_album=album)
                    use_album = new_album[0]
                    photos = Photo.objects.filter(album=use_album)[:1]
                    return photos[0]
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
        return ('photo_manager.views.album', (), {'album_id': self.id, 'album_slug': self.slug, 'username': self.user.username})
        
    @models.permalink
    def get_slideshow(self):
        return ('photo_manager.views.slideshow', (), {'album_slug': self.slug, 'username': self.user.username})


class Photo(models.Model):
    title = models.CharField(max_length=250)
    slug = models.SlugField(editable=False, blank=True)
    file_name = models.CharField(max_length=400, editable=False)
    image = models.ImageField(upload_to="images/", max_length=400)
    description = models.TextField(null=True, blank=True)
    date_uploaded = models.DateTimeField(auto_now=False, auto_now_add=True)
    album = models.ForeignKey(Album)
    user = models.ForeignKey(User)
    location = models.ForeignKey(Location, blank=True, null=True)
    thumbs_created = models.BooleanField(default=False, editable=False)
    
    def __unicode__(self):
        return self.title
    
    def save(self):
        unique_slugify(self, self.title)
        super(Photo, self).save()
    
    @models.permalink
    def get_next(self):
        try:
            next_photo = Photo.objects.filter(id__gt=self.id, user=self.user)[:1]
            photo = next_photo[0]
        except:
            return None
        return ('photo_manager.views.photo', (), {'photo_id': photo.id, 'photo_slug': photo.slug, 'album_slug': photo.album.slug, 'username': photo.user.username})
    
    @models.permalink
    def get_previous(self):
        try:
            prev_photo = Photo.objects.filter(id__lt=self.id, user=self.user)[:1]
            photo = prev_photo[0]
        except:
            return None
        return ('photo_manager.views.photo', (), {'photo_id': photo.id, 'photo_slug': photo.slug, 'album_slug': photo.album.slug, 'username': photo.user.username})
        
    def image_preview(self):
        im = get_thumbnail(self.image, "150x150")
        return '<img src="%s" width="150"/>'  % im.url
    image_preview.allow_tags = True
    
    def make_thumbnails(self):
        # Current Thumb list
        # 240x165 (streams)
        # 75x75 for map (Other location photos)
        # 1024x768 for photo.html
        # 150x150 for thumbs on page.
        
        im = get_thumbnail(self.image, '150x150', crop="center")
        im4 = get_thumbnail(self.image, '75x75', crop="center")
        im2 = get_thumbnail(self.image, '1024x768')
        im3 = get_thumbnail(self.image, '240x165')
    
    @models.permalink
    def get_absolute_url(self):
        if settings.ENABLE_MULTI_USER:
            return ('photo_manager.views.photo', (), {'photo_id': self.id, 'photo_slug': self.slug, 'album_slug': self.album.slug, 'username': self.user.username})
        else:
            return ('photo_manager.views.photo', (), {'photo_id': self.id, 'photo_slug': self.slug, 'album_slug': self.album.slug})
    
    @models.permalink
    def get_fullscreen(self):
        # update with enable multi user
        return ('photo_manager.views.photo_fullscreen', (), {'photo_id': self.id, 'photo_slug': self.slug, 'album_slug': self.album.slug, 'username': self.user.username})
        
        
    class Meta:
        ordering = ['-id']
        
        