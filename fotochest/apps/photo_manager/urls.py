from django.conf.urls.defaults import patterns, include, url
from photo_manager.views import *
from photo_manager.feeds import *
from django.conf import settings
from photo_manager.api import PhotoResource, UserResource, AlbumResource, LocationResource
from tastypie.api import Api

v1_api = Api(api_name='v1')
v1_api.register(UserResource())
v1_api.register(PhotoResource())
v1_api.register(AlbumResource())
v1_api.register(LocationResource())


if settings.ENABLE_MULTI_USER:
    urlpatterns = patterns('',
                           
        # Jobs
        url(r'^thumb_job/$', run_thumb_job),
        url(r'^update_photo_title/$', update_photo_title),
        url(r'^update_album_title/$', update_album_title),
        url(r'^api/docs/', include('api_docs.urls')),
        url(r'^api/', include(v1_api.urls)),
                           
        # Public URLS
        url(r'^$', homepage, name="homepage"),
        

        # Photo
        
        url(r'^foto/(?P<photo_id>\d+)/(?P<username>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<photo_slug>[-\w]+)/$', photo, name="regular_photo_url"),
        url(r'^foto/(?P<photo_id>\d+)/(?P<username>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<photo_slug>[-\w]+)/fullscreen/$', photo_fullscreen),
        url(r'^foto/(?P<photo_id>\d+)/(?P<username>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<photo_slug>[-\w]+)/edit/$', edit_photo),
        url(r'^foto/(?P<photo_id>\d+)/(?P<username>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<photo_slug>[-\w]+)/delete/$', delete_photo),
        url(r'^foto/(?P<photo_id>\d+)/(?P<username>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<photo_slug>[-\w]+)/rotate/(?P<rotate_direction>[-\w]+)/$', rotate_photo),
        
        # ShortURL
        url(r'^f/(?P<photo_id>\d+)/$', photo, name="short_photo_url"),
        
        
        # Map - This is not ideal. Should we have a maps.urls?
        
        url(r'map/$', locations),
        url(r'map/(?P<location_slug>[-\w]+)/$', location),
        url(r'map/(?P<location_slug>[-\w]+)/slideshow/$', slideshow),
        
        url(r'map/user/(?P<username>[-\w]+)/$', locations),
        url(r'map/user/(?P<username>[-\w]+)/(?P<location_slug>[-\w]+)/$', location),
        
        
        # Upload
        url(r'^upload/(?P<username>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<location_slug>[-\w]+)/$', photo_upload, name="file_uploader"),
        url(r'^choose/', choose, name="choose"),
        # Feeds
        url(r'^feed/$', StreamFeed(), name="homepage_feed"),
        
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
