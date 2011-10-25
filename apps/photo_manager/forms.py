from django import forms

from photo_manager.models import Album


class AlbumPhotoChooser(forms.Form):
    album = forms.CharField()
    location = forms.CharField()
    
class AlbumForm(forms.ModelForm):
    class Meta:
        model = Album
        exclude = ('user', 'album_cover',)
        
