from django.conf.urls.defaults import patterns, include, url
from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
    
    #url(r'^admin/', include('photo_admin.urls')),
    url(r'^admin/', include(admin.site.urls)),
    url(r'^static/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': '/srv/www/fotochest/static'}),
    #url(r'upload$', 'photo_manager.views.myFileHandler', name="file_uploader"),
    url(r'^locations/', include('locations.urls')),
    url(r'^api/photos/', include('photo_manager.api.urls')),
    url(r'^', include('photo_manager.urls')),
    
    
)
