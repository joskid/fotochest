from django.test import TestCase
from django.test.client import Client
from photo_manager.models import *

# Test Views, Model Managers, Methods


class ViewTest(TestCase):
    
    fixtures = ['photo_manager_test_data.json']
    urls = 'photo_manager.urls'
    
    def setUp(self):
        self.client = Client()
        
    def test_feed(self):
        response = self.client.get('/feed/')
        self.assertEqual(response.status_code, 200)
        

class AlbumModelTest(TestCase):
    fixtures = ['photo_manager_test_data.json']
    urls = 'photo_manager.urls'
    
    def setUp(self):
        self.client = Client()
    
    def test_child_albums(self):
        album = Album.objects.get(pk=1)
        self.assertEqual(album.has_child_albums(), True)
        album = Album.objects.get(pk=4)
        self.assertEqual(album.has_child_albums(), False)
            