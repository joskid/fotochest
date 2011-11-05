from django.conf.urls.defaults import patterns, include, url
from photo_manager.views import *
from photo_manager.feeds import *

urlpatterns = patterns('',
    
    
    
    #url('^upload$', myFileHandler, name="file_uploader"),
    url(r'^choose/', choose, name="choose"),
    #url('^upload$', photo_upload),
    url(r'^upload_photo/(?P<username>[-\w]+)/(?P<location_slug>[-\w]+)/(?P<album_slug>[-\w]+)', photo_upload, name="file_uploader"),
    url(r'^slideshow/location/(?P<location_slug>[-\w]+)/$', slideshow, name="location_slideshow"),
    url(r'^slideshow/album/(?P<album_slug>[-\w]+)/$', slideshow, name="album_slideshow"),
    
    # Feeds
    url(r'^feed/$', StreamFeed()),
    url(r'^feed/album/(?P<album_slug>[-\w]+)/$', AlbumStream()),
    
    
    # Future: Upload should know about album, and location for the batch.
    url(r'^$', homepage, name="home"),
    url(r'^(?P<user_name>[-\w]+)/$', user_stream, name="user_stream"),
    url(r'^(?P<user_name>[-\w]+)/albums/(?P<album_slug>[-\w]+)/$', album, name="album"),
    url(r'^(?P<user_name>[-\w]+)/albums/$', albums, name="albums"),
    url(r'^(?P<user_name>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<photo_slug>[-\w]+)/$', photo, name="photo"),
    #url(r'^album/(?P<album_slug>[-\w]+)/$', album, name="album"),
    #url(r'^albums/$', albums, name="albums"),
    #url(r'upload/(?P<album_slug>[-\w]+)/$', upload, name="photo_uploader"),
    
    
    
    
)
