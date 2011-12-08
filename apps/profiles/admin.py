from django.contrib import admin
from profiles.models import *
from django.contrib.auth.admin import UserAdmin

class UserProfileInline(admin.StackedInline):
    model = Profile
    fk_name = 'user'
    max_num = 1

class CustomUserAdmin(UserAdmin):
    list_display = ('username', 'first_name', 'last_name', 'is_staff', 'is_superuser' )
    
    show_save_and_continue = False
    filter_horizontal = ['user_permissions', 'groups',]
    inlines = [UserProfileInline,]


admin.site.unregister(User)
admin.site.register(User, CustomUserAdmin)
