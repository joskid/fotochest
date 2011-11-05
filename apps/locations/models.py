from django.db import models
from django.utils import simplejson
import urllib
from locations.choices import *
from nutsbolts.utils.slugs import unique_slugify


class Location(models.Model):
    city = models.CharField(max_length=250)
    state = models.CharField(max_length=250, choices=STATE_CHOICES, blank=True, help_text="State is not required if you are out of the country.")
    country = models.CharField(max_length=50, choices=COUNTRY_CHOICES, blank=True)
    latitude = models.CharField(max_length=250, blank=True, editable=False)
    longitude = models.CharField(max_length=250, blank=True, editable=False)
    slug = models.SlugField(editable=False)
    default_location = models.BooleanField()
    
    def __unicode__(self):
        if self.state:
            return "%s, %s" % (self.city, self.state)
        else:
            return "%s, %s" % (self.city, self.country)
            
    def get_photo_count(self):
        from photo_manager.models import Photo
        return Photo.objects.filter(location=self).count()
    
    @models.permalink
    def get_absolute_url(self):
        return ('locations.views.location', (), {'location_slug': self.slug})
    
    
    def save(self, *args, **kwargs):
        slug_title = self.city + self.country
        unique_slugify(self, slug_title)
        location = "%s+%s+%s" % (self.city, self.state, self.country)
        # Use google API to get silly stuff back
        google_feed = 'http://maps.googleapis.com/maps/api/geocode/json?address=' + location + '&sensor=false'
        map_data = urllib.urlopen(google_feed)
        map_json = map_data.read()
        map_object = simplejson.loads(map_json)
        result_object = map_object['results']
        location = result_object[0]['geometry']
        geos = location['location']
        self.latitude = geos['lat']
        self.longitude = geos['lng']
        super(Location, self).save(*args, **kwargs)
    