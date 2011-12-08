from tastypie.resources import ModelResource
from photo_manager.models import Photo, Album
from locations.models import Location
from django.contrib.auth.models import User
from tastypie import fields
from sorl.thumbnail import get_thumbnail

class UserResource(ModelResource):
    class Meta:
        queryset = User.objects.all()
        resource_name = 'user'
        excludes = ['email', 'password', 'is_active', 'is_staff', 'is_superuser']
        allowed_methods = ['get']

class AlbumResource(ModelResource):
    class Meta:
        queryset = Album.objects.all()
        resource = 'album'
        allowed_methods=['get']

class LocationResource(ModelResource):
    class Meta:
        queryset = Location.objects.all()
        resource_name = 'location'
        allowed_methods = ['get']


class PhotoResource(ModelResource):
    user = fields.ForeignKey(UserResource, 'user')
    album = fields.ForeignKey(AlbumResource, 'album')
    location = fields.ForeignKey(LocationResource, 'location')
    
    class Meta:
        queryset = Photo.objects.all()
        resource_name = 'photo'
        include_absolute_url = True
        excludes = ['thumbs_created', 'file_name']
        
    def build_filters(self, filters=None):
        if filters is None:
            filters = {}
        orm_filters = super(PhotoResource, self).build_filters(filters)
        if "album_id" in filters:
            orm_filters['album__id'] = filters['album_id']
        if "username" in filters:
            orm_filters['user__username'] = filters['username']
        return orm_filters
        
    def dehydrate(self, bundle):
        thumb_obj = get_thumbnail(bundle.obj.image, "240x165")
        thumb_square = get_thumbnail(bundle.obj.image, "75x75", crop="center")
        thumb_large = get_thumbnail(bundle.obj.image, "1024x768")
        bundle.data['thumb'] = thumb_obj.url
        bundle.data['thumb_square'] = thumb_square.url
        bundle.data['thumb_large'] = thumb_large.url
        return bundle
        