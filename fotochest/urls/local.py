from django.conf.urls.defaults import patterns, include, url
from django.contrib.staticfiles.urls import staticfiles_urlpatterns
from django.contrib import admin
admin.autodiscover()
from django.conf import settings
from django.contrib.staticfiles.urls import staticfiles_urlpatterns

# This maps static files dirs to URLS.
urlpatterns = staticfiles_urlpatterns() + patterns('',

    # Admin URLS.
    url(r'^admin/', include(admin.site.urls)),
    url(r'^grappelli/', include('grappelli.urls')),
    
    # Auth Views
    url(r'^accounts/login/$', 'django.contrib.auth.views.login', {'template_name': '%s/login.html' % settings.ACTIVE_THEME}),
    url(r'^accounts/logout/$', 'django.contrib.auth.views.logout', {'next_page': '/'}),
    url(r'^accounts/redirect/$', 'profiles.views.redirect_home'),
    url(r'^accounts/register/$', 'profiles.views.register'),
    url(r'^accounts/register/part_two/(?P<username>[-\w]+)/$', 'profiles.views.register_part_two'),
    url(r'^accounts/profiles/(?P<username>[-\w]+)/$', 'profiles.views.view_profile'),
    url(r'^accounts/profile/edit/$', 'profiles.views.edit_profile'),

    #API Docs
    url(r'^docs/', include('api_docs.urls')),
    
    # Media URLs.  
    url(r'^media/(?P<path>.*)$', 'django.views.static.serve',
        {'document_root': './uploads'}),
    
    # Send all remaming URLS to the App.
    url(r'^', include('photo_manager.urls')),
)

