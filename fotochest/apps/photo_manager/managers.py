from datetime import datetime
from django.db import models
from django.db.models.query import QuerySet

class PhotoMixin(object):
    def active(self):
        return self.filter(deleted=False)
        
class PhotoQuerySet(QuerySet, PhotoMixin):
    pass

class PhotoManager(models.Manager, PhotoMixin):
    def get_query_set(self):
        return PhotoQuerySet(self.model, using=self._db)

