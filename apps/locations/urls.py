from django.conf.urls.defaults import patterns, include, url
from locations.views import *

urlpatterns = patterns('',
                       
    url(r'^$', locations, name="locations"),
    url(r'^(?P<location_slug>[-\w]+)/$', location),
)
