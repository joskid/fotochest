from django.test import TestCase
from django.test.client import Client



class ViewTest(TestCase):
    
    fixtures = ['photo_manager_test_data.json']
    urls = 'photo_manager.urls'
    
    def setUp(self):
        self.client = Client()
        
    def test_feed(self):
        response = self.client.get('/feed/')
        self.assertEqual(response.status_code, 200)