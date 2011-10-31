from django.conf.urls.defaults import patterns, include, url
from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
    
    
    
    url(r'^admin/', include(admin.site.urls)),
    url(r'^grappelli/', include('grappelli.urls')),
    url(r'^static/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': './static'}),
    url(r'^map/', include('locations.urls')),
    url(r'^accounts/login/$', 'django.contrib.auth.views.login', {'template_name': 'login.html'}),
    url(r'^accounts/logout/$', 'django.contrib.auth.views.logout', {'next_page': '/'}),
    url(r'^accounts/redirect/$', 'profiles.views.redirect_home'),
    url(r'^api/photos/', include('photo_manager.api.urls')),
    url(r'^', include('photo_manager.urls')),
    url(r'^static_admin/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': './admin_media'}),
    url(r'^media/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': './uploads'}),
)
