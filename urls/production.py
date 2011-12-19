from django.conf.urls.defaults import patterns, include, url
from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
    
    # Admin URLS
    url(r'^admin/', include(admin.site.urls)),
    url(r'^grappelli/', include('grappelli.urls')),

    # Auth Views   
    url(r'^accounts/login/$', 'django.contrib.auth.views.login', {'template_name': 'login.html'}),
    url(r'^accounts/logout/$', 'django.contrib.auth.views.logout', {'next_page': '/'}),
    url(r'^accounts/redirect/$', 'profiles.views.redirect_home'),
    url(r'^accounts/register/$', 'profiles.views.register'),
    url(r'^accounts/register/part_two/(?P<username>[-\w]+)/$', 'profiles.views.register_part_two'),
    url(r'^accounts/profiles/(?P<username>[-\w]+)/$', 'profiles.views.view_profile'),
    url(r'^accounts/profile/edit/$', 'profiles.views.edit_profile'),
    
    # API Docs
    url(r'^docs/', 'api_docs.urls'),
    
    # ALL Others to App.
    url(r'^', include('photo_manager.urls')),
    
    
)
