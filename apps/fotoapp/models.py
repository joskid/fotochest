from django.db import models
from django.template.defaultfilters import slugify
from fotoapp.choices import *
from django.utils import simplejson
import urllib

class AlbumManager(models.Manager):
    def published(self):
        return Album.objects.filter(published=True)

class PhotoManager(models.Manager):
    def published(self):
        return Photo.objects.filter(published=True)


class Album(models.Model):
    title = models.CharField(max_length=250)
    slug = models.SlugField(editable=False)
    published = models.BooleanField()
    
    objects = AlbumManager()
    
    def __unicode__(self):
        return self.title
    
    def save(self):
        self.slug = slugify(self.title)
        super(Album, self).save()
    
    @models.permalink
    def get_absolute_url(self):
        return ('fotoapp.views.album', (), {'album_slug': self.slug})



class Photo(models.Model):
    title = models.CharField(max_length=250)
    slug = models.SlugField(editable=False)
    description = models.TextField(blank=True)
    city_taken = models.CharField(max_length=250, blank=True)
    state_taken = models.CharField(max_length=250, blank=True, choices=STATE_CHOICES)
    country_taken = models.CharField(max_length=250, blank=True, choices=COUNTRY_CHOICES)
    date_uploaded = models.DateField(auto_now=True, auto_now_add=True)
    published = models.BooleanField()
    album = models.ForeignKey(Album)
    image = models.ImageField(upload_to='fotoapp/images/', blank=True)
    latitude = models.CharField(max_length=250, blank=True, editable=False)
    longitude = models.CharField(max_length=250, blank=True, editable=False)
    
    
    objects = PhotoManager()
    
    def __unicode__(self):
        return self.title
    
    def save(self):
        if self.city_taken:
            location = "%s+%s+%s" % (self.city_taken, self.state_taken, self.country_taken)
            google_feed = 'http://maps.googleapis.com/maps/api/geocode/json?address=' + location + '&sensor=false'
            map_data = urllib.urlopen(google_feed)
            map_json = map_data.read()
            map_object = simplejson.loads(map_json)
            result_object = map_object['results']
            location = result_object[0]['geometry']
            geos = location['location']
            self.latitude = geos['lat']
            self.longitude = geos['lng']
        self.slug = slugify(self.title)
        super(Photo, self).save()
    
    
    @models.permalink
    def get_absolute_url(self):
        return ('fotoapp.views.photo', (), {'album_slug': self.album.slug, 'photo_slug': self.slug})
