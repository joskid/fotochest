
from django.conf import settings
from django.core.urlresolvers import reverse

class SWFUploadMiddleware(object):
    def process_request(self, request):
        if (request.method == 'POST') and (request.path == reverse('photo_manager.views.myFileHandler')) and \
                request.POST.has_key(settings.SESSION_COOKIE_NAME):
            request.COOKIES[settings.SESSION_COOKIE_NAME] = request.POST[settings.SESSION_COOKIE_NAME]
            

# URLS if enable multi user
## --> For User
# User PhotoStream
# User Albums
# User Album
# User PhotoStream Slideshow
# User Album Slideshow
# Individual photo
# mAp
# Upload


# Public Photo Stream
# Public Slideshow Photo Stream

# Everyones MAp

# If not multiuser.
## Stream
## Albums
## Individual Photo
## Map
## Upload
## Homepage is stream
