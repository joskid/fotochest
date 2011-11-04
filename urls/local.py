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
    url(r'^accounts/register/$', 'profiles.views.register'),
    url(r'^accounts/register/part_two/(?P<username>[-\w]+)/$', 'profiles.views.register_part_two'),
    url(r'^accounts/profiles/(?P<username>[-\w]+)/$', 'profiles.views.view_profile'),
    url(r'^accounts/profile/edit/$', 'profiles.views.edit_profile'),
    #url(r'^api/photos/', include('photo_manager.api.urls')),
    
    url(r'^static_admin/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': './admin_media'}),
    url(r'^media/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': './uploads'}),
    url(r'^docs/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': './docs/build/html'}),
    url(r'^', include('photo_manager.urls')),
)
