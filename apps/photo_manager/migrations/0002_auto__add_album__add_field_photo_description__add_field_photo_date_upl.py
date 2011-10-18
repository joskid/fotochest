# encoding: utf-8
import datetime
from south.db import db
from south.v2 import SchemaMigration
from django.db import models

class Migration(SchemaMigration):

    def forwards(self, orm):
        
        # Adding model 'Album'
        db.create_table('photo_manager_album', (
            ('id', self.gf('django.db.models.fields.AutoField')(primary_key=True)),
            ('title', self.gf('django.db.models.fields.CharField')(max_length=250)),
            ('date_created', self.gf('django.db.models.fields.DateTimeField')(auto_now=True, auto_now_add=True, blank=True)),
            ('parent_album', self.gf('django.db.models.fields.related.ForeignKey')(to=orm['photo_manager.Album'])),
        ))
        db.send_create_signal('photo_manager', ['Album'])

        # Adding field 'Photo.description'
        db.add_column('photo_manager_photo', 'description', self.gf('django.db.models.fields.TextField')(default=''), keep_default=False)

        # Adding field 'Photo.date_uploaded'
        db.add_column('photo_manager_photo', 'date_uploaded', self.gf('django.db.models.fields.DateTimeField')(auto_now=True, auto_now_add=True, default=datetime.datetime(2011, 9, 29, 10, 33, 20, 504519), blank=True), keep_default=False)

        # Adding field 'Photo.album'
        db.add_column('photo_manager_photo', 'album', self.gf('django.db.models.fields.related.ForeignKey')(default='1', to=orm['photo_manager.Album']), keep_default=False)


    def backwards(self, orm):
        
        # Deleting model 'Album'
        db.delete_table('photo_manager_album')

        # Deleting field 'Photo.description'
        db.delete_column('photo_manager_photo', 'description')

        # Deleting field 'Photo.date_uploaded'
        db.delete_column('photo_manager_photo', 'date_uploaded')

        # Deleting field 'Photo.album'
        db.delete_column('photo_manager_photo', 'album_id')


    models = {
        'photo_manager.album': {
            'Meta': {'object_name': 'Album'},
            'date_created': ('django.db.models.fields.DateTimeField', [], {'auto_now': 'True', 'auto_now_add': 'True', 'blank': 'True'}),
            'id': ('django.db.models.fields.AutoField', [], {'primary_key': 'True'}),
            'parent_album': ('django.db.models.fields.related.ForeignKey', [], {'to': "orm['photo_manager.Album']"}),
            'title': ('django.db.models.fields.CharField', [], {'max_length': '250'})
        },
        'photo_manager.photo': {
            'Meta': {'object_name': 'Photo'},
            'album': ('django.db.models.fields.related.ForeignKey', [], {'to': "orm['photo_manager.Album']"}),
            'date_uploaded': ('django.db.models.fields.DateTimeField', [], {'auto_now': 'True', 'auto_now_add': 'True', 'blank': 'True'}),
            'description': ('django.db.models.fields.TextField', [], {}),
            'id': ('django.db.models.fields.AutoField', [], {'primary_key': 'True'}),
            'title': ('django.db.models.fields.CharField', [], {'max_length': '250'})
        }
    }

    complete_apps = ['photo_manager']
