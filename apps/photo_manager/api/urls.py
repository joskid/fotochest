from django.conf.urls.defaults import *
from piston.resource import Resource
from photo_manager.api.handlers.photo import PhotoHandler
from photo_manager.api.handlers.album import AlbumHandler
from api_manager.utils import CsrfExemptResource


photo_handler = CsrfExemptResource(PhotoHandler)
album_handler = CsrfExemptResource(AlbumHandler)

urlpatterns = patterns('',
    url(r'^photo$', photo_handler),
    url(r'^photo/(?P<photo_id>\d+)$', photo_handler),
    url(r'^album$', album_handler),
    url(r'^album/(?P<album_id>\d+)/$', album_handler),
    #url(r'^recipe/(?P<recipe_id>\d+)$', single_recipe_handler),
)