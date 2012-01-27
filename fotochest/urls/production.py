from django.conf.urls.defaults import patterns, include, url
from django.contrib import admin
admin.autodiscover()
from django.conf import settings

urlpatterns = patterns('',
    
    # Admin URLS
    url(r'^admin/', include(admin.site.urls)),
    url(r'^grappelli/', include('grappelli.urls')),
    #url(r'^map/', include('locations.urls')),
    url(r'^accounts/login/$', 'django.contrib.auth.views.login', {'template_name': '%s/login.html' % settings.ACTIVE_THEME}),
    url(r'^accounts/logout/$', 'django.contrib.auth.views.logout', {'next_page': '/'}),
    url(r'^accounts/redirect/$', 'profiles.views.redirect_home'),
    url(r'^accounts/register/$', 'profiles.views.register'),
    url(r'^accounts/register/part_two/(?P<username>[-\w]+)/$', 'profiles.views.register_part_two'),
    url(r'^accounts/profiles/(?P<username>[-\w]+)/$', 'profiles.views.view_profile'),
    url(r'^accounts/profile/edit/$', 'profiles.views.edit_profile'),
    url(r'^docs/', include("api_docs.urls")),
    url(r'^', include('photo_manager.urls')),
    
    
)
