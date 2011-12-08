from django.conf.urls.defaults import patterns, include, url
from locations.views import *
from django.conf import settings


if settings.ENABLE_MULTI_USER:
    urlpatterns = patterns('',
        
        
        # Map
        url(r'^$', locations),
        url(r'^(?P<location_slug>[-\w]+)/$', location),
        url(r'^(?P<location_slug>[-\w]+)/slideshow/$', 'photo_manager.views.slideshow'),
        
        url(r'^user/(?P<username>[-\w]+)/$', locations),
        url(r'^user/(?P<username>[-\w]+)/(?P<location_slug>[-\w]+)/$', location),
        
                           
                           )
else:
    urlpatterns = patterns('',
        #url(r'^$', homepage, name="homepage"),
        #url(r'^albums/', albums, name="albums"),
        #url(r'^album/(?P<album_slug>[-\w]+)/$', album, name="album"),
        #url(r'^photo/(?P<photo_slug>[-\w]+)/$', photo, name="photo"),
        #url(r'^map/$', map, name="map"),
        #url(r'^map/(?P<location_slug>[-\w]+)/$', map_location, name="map_location"),
        #url(r'^upload$', upload, name="upload"),
        #url(r'^choose/$', choose, name="choose"),
        
        # Feeds
        # Slideshow
        
                           )

