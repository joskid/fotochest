from django.conf.urls.defaults import patterns, include, url
from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
    
    
    url(r'^fotochest/', include('photo_manager.urls')),
    url(r'^django_admin/', include(admin.site.urls)),
    url(r'^admin/', include('photo_admin.urls')),
    url(r'^static/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': './static'}),
    
    url(r'^static_admin/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': './admin_media'}),
    url(r'^media/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': './upload'}),
)
