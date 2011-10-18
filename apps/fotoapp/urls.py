from django.conf.urls.defaults import patterns, include, url
from fotoapp.views import *

urlpatterns = patterns('',

    url(r'^$', home, name="home"),
    url(r'^album/(?P<album_slug>[-\w]+)/$', album, name="album"),
    url(r'^albums/$', albums, name="albums"),
    url(r'^photo/(?P<photo_slug>[-\w]+)/$', photo, name="photo"),
)
