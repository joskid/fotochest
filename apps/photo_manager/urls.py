from django.conf.urls.defaults import patterns, include, url
from photo_manager.views import *

urlpatterns = patterns('',
    
    
    
    #url('^upload$', myFileHandler, name="file_uploader"),
    url(r'^$', homepage, name="home"),
    url(r'^(?P<user_name>[-\w]+)/$', user_stream, name="user_stream"),
    url(r'^(?P<user_name>[-\w]+)/albums/(?P<album_slug>[-\w]+)/$', album, name="album"),
    url(r'^(?P<user_name>[-\w]+)/albums/$', albums, name="albums"),
    url(r'^(?P<user_name>[-\w]+)/(?P<album_slug>[-\w]+)/(?P<photo_slug>[-\w]+)/$', photo, name="photo"),
    #url(r'^album/(?P<album_slug>[-\w]+)/$', album, name="album"),
    #url(r'^albums/$', albums, name="albums"),
    #url(r'upload/(?P<album_slug>[-\w]+)/$', upload, name="photo_uploader"),
    
    
)
