import os, sys, site

sys.path.append('/fotochest')
site.addsitedir('/lib/python2.7/site-packages')

os.environ['DJANGO_SETTINGS_MODULE'] = 'settings.production'

from django.core.handlers.wsgi import WSGIHandler
application = WSGIHandler()

#sys.stdout = sys.stderr