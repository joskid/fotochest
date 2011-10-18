from django.conf.urls.defaults import patterns, include, url
from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
    
    url(r'^admin/', include('photo_admin.urls')),
    url(r'^django_admin/', include(admin.site.urls)),
    url(r'^static/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': '/home/dstegelman/webapps/fotochest/htdocs/assets'}),
    #url(r'upload$', 'photo_manager.views.myFileHandler', name="file_uploader"),
    url(r'^', include('photo_manager.urls')),
    
    
)
