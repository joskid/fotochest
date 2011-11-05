from django.contrib import admin
from photo_manager.models import *


class PhotoAdmin(admin.ModelAdmin):
    list_display = ('title', 'album', 'location', 'image_preview', 'thumbs_created')
    list_per_page = 10
    
class AlbumAdmin(admin.ModelAdmin):
    list_display = ('title', 'parent_album', 'user')
    
admin.site.register(Photo, PhotoAdmin)
admin.site.register(Album, AlbumAdmin)


