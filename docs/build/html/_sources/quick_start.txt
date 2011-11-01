Quick Start Guide
=================


Requirements
------------

Fotochest requires::

    south
    sorl-thumbnail
    django 1.3 or greater



Installation
------------

Using ``pip``::

    pip install git+git://github.com/fotochest/fotochest.git

Go to https://github.com/fotochest/fotochest if you need to download a package or clone the repo.


Setup
-----

Open ``settings.py`` and add``photo_manager``, ``'sorl.thumbnail'``, ``locations``, ``south``, and ``profiles`` to your ``INSTALLED_APPS``::

    INSTALLED_APPS = (
        'photo_manager',
        'south',
        'sorl.thumbnail',
        'locations',
        'profiles',
    )
    
Open ``settings.py`` and add the following to TEMPLATE_CONTEXT_PROCESSORS::

    TEMPLATE_CONTEXT_PROCESSORS = (
    "django.core.context_processors.auth",
    "django.core.context_processors.debug",
    "django.core.context_processors.media",
    "django.core.context_processors.static",
    "django.core.context_processors.request",
    "django.contrib.messages.context_processors.messages",
    "photo_manager.context_processors.theme_files",
    "photo_manager.context_processors.locations_albums",
) 

Add URL-patterns::

    urlpatterns = patterns('',
        url(r'^fotochest/', include('photo_manager.urls')),
        url(r'^map/', include('locations.urls')),
        url(r'^accounts/login/$', 'django.contrib.auth.views.login', {'template_name': 'login.html'}),
        url(r'^accounts/logout/$', 'django.contrib.auth.views.logout', {'next_page': '/'}),
        url(r'^accounts/redirect/$', 'profiles.views.redirect_home'),
    )
    
Add custom settings parameters::

PHOTO_DIRECTORY = os.path.join(SITE_ROOT, 'uploads/images')
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Image upload location

    
DOMAIN_STATIC = 'http://localhost:8000/static/'
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The same as STATIC_URL unless you have a subdomain specified for static content.  The flash uploader requires same-domai resources, so whatever domain you are serving
Fotochest from, you must also include a static directory here.


ENABLE_MULTI_USER = True
~~~~~~~~~~~~~~~~~~~~~~~~

Enable multiple users on the site.

Static Files
------------

If you intend on using the default template, you'll need to grab the static files off of https://github.com/dstegelman/django-interactive-api-docs and copy them into an api_docs folder that can be seen 
by your static web server.

