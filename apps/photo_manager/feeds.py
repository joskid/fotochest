from django.contrib.syndication.views import Feed
from photo_manager.models import *

class StreamFeed(Feed):
    title = "FotoChest Photo Stream"
    link = "/photo"
    description = "RSS Feed of the Photo Stream"
    
    def items(self):
        return Photo.objects.all()[:20]
        
    def item_title(self, item):
        return item.title
    
    def item_description(self, item):
        return item.description
    
class AlbumStream(Feed):
    title = "FotoChest Album Stream"
    link = "/album"
    description = "RSS Feed of the Album Stream"
    
    def get_object(self, request, album_slug):
        return get_object_or_404(Album, slug=album_slug)
    
    def items(self, obj):
        return Photo.objects.filter(album=obj)[:20]
        
    def item_title(self, item):
        return item.title
    
    def item_description(self, item):
        return item.description
        
    