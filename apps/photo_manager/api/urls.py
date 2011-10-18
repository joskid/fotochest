from django.conf.urls.defaults import *
from piston.resource import Resource
from photo_manager.api.handlers.photo import PhotoHandler
from api_manager.utils import CsrfExemptResource


photo_handler = CsrfExemptResource(PhotoHandler)


urlpatterns = patterns('',
    url(r'^photo$', photo_handler),
    #url(r'^recipe/(?P<recipe_id>\d+)$', single_recipe_handler),
)