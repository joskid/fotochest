from django.conf.urls.defaults import patterns, include, url
from photo_manager.views import *
from photo_manager.feeds import *
from django.conf import settings


if settings.ENABLE_MULTI_USER:
    urlpatterns = patterns('',
                           
        # Jobs
        url(r'^thumb_job/$', run_thumb_job),
        url(r'^update_photo_title/$', update_photo_title),
                           
        # Public URLS
        url(r'^$', homepage, name="homepage"),

        # Photo
        
        url(r'^foto/(?P<photo_id>\d+)/(?P<username>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<photo_slug>[-\w]+)/$', photo),
        url(r'^foto/(?P<photo_id>\d+)/(?P<username>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<photo_slug>[-\w]+)/fullscreen/$', photo_fullscreen),
        
        # Upload
        url(r'^upload/(?P<username>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<location_slug>[-\w]+)/$', photo_upload, name="file_uploader"),
        url(r'^choose/', choose, name="choose"),
        # Feeds
        url(r'^feed/$', StreamFeed()),
        
        # User stream
        url(r'^(?P<username>[-\w]+)/$', homepage),

        # Albums
        url(r'^(?P<username>[-\w]+)/albums/$', albums),
        url(r'^(?P<username>[-\w]+)/album/(?P<album_id>\d+)/(?P<album_slug>[-\w]+)/$', album),
        url(r'^(?P<username>[-\w]+)/album/(?P<album_slug>[-\w]+)/slideshow/$', slideshow),
        
        
        
                           
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
#urlpatterns = patterns('',
    
    
    
    #url('^upload$', myFileHandler, name="file_uploader"),
    #url(r'^choose/', choose, name="choose"),
    #url('^upload$', photo_upload),
    #url(r'^upload_photo/(?P<username>[-\w]+)/(?P<location_slug>[-\w]+)/(?P<album_slug>[-\w]+)', photo_upload, name="file_uploader"),
    #url(r'^slideshow/location/(?P<location_slug>[-\w]+)/$', slideshow, name="location_slideshow"),
    #url(r'^slideshow/album/(?P<album_slug>[-\w]+)/$', slideshow, name="album_slideshow"),
    
    # Feeds
    #url(r'^feed/$', StreamFeed()),
    #url(r'^feed/album/(?P<album_slug>[-\w]+)/$', AlbumStream()),
    
    
    # Future: Upload should know about album, and location for the batch.
    #url(r'^$', homepage, name="home"),
    #url(r'^(?P<user_name>[-\w]+)/$', user_stream, name="user_stream"),
    #url(r'^(?P<user_name>[-\w]+)/albums/(?P<album_slug>[-\w]+)/$', album, name="album"),
    #url(r'^(?P<user_name>[-\w]+)/albums/$', albums, name="albums"),
    #url(r'^(?P<user_name>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<photo_slug>[-\w]+)/$', photo, name="photo"),
    #url(r'^album/(?P<album_slug>[-\w]+)/$', album, name="album"),
    #url(r'^albums/$', albums, name="albums"),
    #url(r'upload/(?P<album_slug>[-\w]+)/$', upload, name="photo_uploader"),
    
#)
