from django import forms


class ProfileForm(forms.Form):
    first_name = forms.CharField(max_length=250)
    last_name = forms.CharField(max_length=250)
    email = forms.EmailField(max_length=250)