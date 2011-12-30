from django.test import TestCase
from django.test.client import Client
from photo_manager.models import *
from django.core.urlresolvers import reverse
# Test Views, Model Managers, Methods


class ViewTest(TestCase):
    
    fixtures = ['photo_manager_test_data.json']
    urls = 'urls.local'
    
    def setUp(self):
        self.client = Client()
        
    def test_feed(self):
        response = self.client.get('/feed/')
        self.assertEqual(response.status_code, 200)
        
    def test_home(self):
        response = self.client.get("/")
        self.assertEqual(response.status_code, 200)
        
        
    def test_albums_no_username(self):
        response = self.client.get("/albums/")
        self.assertEqual(response.status_code, 200)

    def test_albums_username(self):
        response = self.client.get("/john/albums/")
        self.assertEqual(response.status_code, 200)
    
    def test_single_photo_short_url(self):
        response = self.client.get("/f/705/")
        self.assertEqual(response.status_code, 200)
        
    def test_global_map(self):
        response = self.client.get("/map/")
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
            