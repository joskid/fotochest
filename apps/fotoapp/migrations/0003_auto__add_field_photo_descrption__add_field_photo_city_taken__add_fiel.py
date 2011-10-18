# encoding: utf-8
import datetime
from south.db import db
from south.v2 import SchemaMigration
from django.db import models

class Migration(SchemaMigration):

    def forwards(self, orm):
        
        # Adding field 'Photo.descrption'
        db.add_column('fotoapp_photo', 'descrption', self.gf('django.db.models.fields.TextField')(default=''), keep_default=False)

        # Adding field 'Photo.city_taken'
        db.add_column('fotoapp_photo', 'city_taken', self.gf('django.db.models.fields.CharField')(default='', max_length=250, blank=True), keep_default=False)

        # Adding field 'Photo.state_taken'
        db.add_column('fotoapp_photo', 'state_taken', self.gf('django.db.models.fields.CharField')(default='', max_length=250, blank=True), keep_default=False)

        # Adding field 'Photo.country_taken'
        db.add_column('fotoapp_photo', 'country_taken', self.gf('django.db.models.fields.CharField')(default='', max_length=250, blank=True), keep_default=False)

        # Adding field 'Photo.latitude'
        db.add_column('fotoapp_photo', 'latitude', self.gf('django.db.models.fields.CharField')(default='', max_length=250, blank=True), keep_default=False)

        # Adding field 'Photo.longitude'
        db.add_column('fotoapp_photo', 'longitude', self.gf('django.db.models.fields.CharField')(default='', max_length=250, blank=True), keep_default=False)


    def backwards(self, orm):
        
        # Deleting field 'Photo.descrption'
        db.delete_column('fotoapp_photo', 'descrption')

        # Deleting field 'Photo.city_taken'
        db.delete_column('fotoapp_photo', 'city_taken')

        # Deleting field 'Photo.state_taken'
        db.delete_column('fotoapp_photo', 'state_taken')

        # Deleting field 'Photo.country_taken'
        db.delete_column('fotoapp_photo', 'country_taken')

        # Deleting field 'Photo.latitude'
        db.delete_column('fotoapp_photo', 'latitude')

        # Deleting field 'Photo.longitude'
        db.delete_column('fotoapp_photo', 'longitude')


    models = {
        'fotoapp.album': {
            'Meta': {'object_name': 'Album'},
            'id': ('django.db.models.fields.AutoField', [], {'primary_key': 'True'}),
            'published': ('django.db.models.fields.BooleanField', [], {'default': 'False'}),
            'slug': ('django.db.models.fields.SlugField', [], {'max_length': '50', 'db_index': 'True'}),
            'title': ('django.db.models.fields.CharField', [], {'max_length': '250'})
        },
        'fotoapp.photo': {
            'Meta': {'object_name': 'Photo'},
            'album': ('django.db.models.fields.related.ForeignKey', [], {'to': "orm['fotoapp.Album']"}),
            'city_taken': ('django.db.models.fields.CharField', [], {'max_length': '250', 'blank': 'True'}),
            'country_taken': ('django.db.models.fields.CharField', [], {'max_length': '250', 'blank': 'True'}),
            'date_uploaded': ('django.db.models.fields.DateField', [], {'auto_now': 'True', 'auto_now_add': 'True', 'blank': 'True'}),
            'descrption': ('django.db.models.fields.TextField', [], {}),
            'id': ('django.db.models.fields.AutoField', [], {'primary_key': 'True'}),
            'image': ('django.db.models.fields.files.ImageField', [], {'max_length': '100', 'blank': 'True'}),
            'latitude': ('django.db.models.fields.CharField', [], {'max_length': '250', 'blank': 'True'}),
            'longitude': ('django.db.models.fields.CharField', [], {'max_length': '250', 'blank': 'True'}),
            'published': ('django.db.models.fields.BooleanField', [], {'default': 'False'}),
            'slug': ('django.db.models.fields.SlugField', [], {'max_length': '50', 'db_index': 'True'}),
            'state_taken': ('django.db.models.fields.CharField', [], {'max_length': '250', 'blank': 'True'}),
            'title': ('django.db.models.fields.CharField', [], {'max_length': '250'})
        }
    }

    complete_apps = ['fotoapp']
