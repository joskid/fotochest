from piston.handler import BaseHandler, AnonymousBaseHandler
from piston.utils import *
from photo_manager.models import Album
from django.http import *
from django.shortcuts import *
from django.db.models import Q
from api_manager.utils import *
import logging
from sorl.thumbnail import get_thumbnail

   
class AlbumHandler(BaseHandler):
    allowed_methods = ('GET', 'PUT', 'DELETE', 'POST')
    model = Album
    fields = ('id', 'name', 'slug', 'description', ('parent_album', ('id', 'name', 'slug',),),)
    
    def read(self, request, album_id=None):
        
        if album_id == None:
            limit = request.GET.get('limit', '100')
            if limit != 'all':
                base = Album.objects.all()[:limit]
            else:
                base = Album.objects.all()
            return base
        else:
            try:
                album = get_object_or_404(Album, pk=album_id)
            except Album.DoesNotExist:
                return rc.NOT_FOUND
            
            return album
        
    def create(self, request):
        if request.POST:
            attrs = self.flatten_dict(request.POST)
            category = Category(name=attrs['name'])
            category.published = True
            category.save()
            return category

    @throttle(10, 5)
    def delete(self, request, category_id):
        key_dict = {'key': request.GET.get('key')}
        if key_exists(key_dict) == False:
            return key_required_error()
        if key_check(key_dict):
            try:
                category  = Category.objects.get(pk=category_id)
                
            except Category.DoesNotExist:
                return rc.NOT_FOUND
            category.delete()
            #log_use(request.GET.get('key'), 'Recipe Category', category_id, 'deleted')
            return rc.DELETED
        else:
            return key_incorrect_error()
                        
    @throttle(10, 5)
    def update(self, request, category_id):
        attrs = self.flatten_dict(request.PUT)
        
        key_dict = {'key': request.GET.get('key')}
        
        if key_exists(key_dict) == False:
            return key_required_error()
        if key_check(key_dict):
            try:
                category = Category.objects.get(pk=category_id)
                
            except Category.DoesNotExist:
                return rc.NOT_FOUND
            
            category.name = attrs['name']
            category.save()
            return category
        else:
            return key_incorrect_error()
