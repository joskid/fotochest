from django.conf.urls.defaults import patterns, include, url
from photo_admin.views import *

urlpatterns = patterns('',
    
    
    
    #url('^upload$', myFileHandler, name="file_uploader"),
    url(r'^$', dashboard, name="dashboard"),
    url(r'^album/(?P<album_slug>[-\w]+)/$', view_album, name="view_album"),
    url(r'^albums/$', albums, name="albums"),
    url(r'^create_album/$', create_album, name="create_album"),
    url(r'upload/(?P<album_slug>[-\w]+)/$', upload, name="photo_uploader"),
    #url(r'^photo/(?P<photo_slug>[-\w]+)/$', photo, name="photo"),
    
)
