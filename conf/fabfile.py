from __future__ import with_statement
from project import *
from fabric.api import *
import os
import glob
import time

env.id = PROJECT_ID
env.user = PROJECT_USER
env.hosts = PROJECT_HOSTS

env.directory = '~/projects/%s' % PROJECT_ID
env.virtual_dir = '~/.virtualenvs'
env.static_dir = '~/static/prod'
env.project_virtual = '~/.virtualenvs/%s' % PROJECT_ID
env.activate = 'source ~/.virtualenvs/%s/bin/activate' % PROJECT_ID
env.deploy_user = PROJECT_USER
env.apache_bin_dir = "~/apache2/bin"
env.log_location = "~/logs/app.log"
env.git_repo = "git@something.git"
env.production_branch = "prod-2"
env.docs_dir = "~/webapps/docs_static/fotochest"

# Utility Methods
def view_log():
    run('cat %s' % env.log_location)

# Local Development
def run_local_server():
    local("python manage.py runserver --settings=settings.local")
    
def run_local():
    pip_install_req('local')
    sync_db('local')
    migrate('local')
    run_local_server()
    
def test(app=None):
    if app:
        local('python manage.py test %s --settings=settings.local' % app)
    else:
        local('python manage.py test --settings=settings.local')
    
def push(branch):
   local("git push origin %s" % branchs) 

# Helper Methods
def virtualenv(command):
    with cd(env.directory):
        run(env.activate + '&&' + command)

def pip_install_req(env):
    if env == 'local':
        local("pip install -r conf/requirements.txt")
    else:
        virtualenv('pip install -r conf/requirements.txt') 

def get_code_latest():
    with cd(env.directory):
        run('git pull origin %s' % env.git_production_branch)
        

        
def publish_docs():
    with cd(env.directory + '/docs/build/html'):
        run('cp -r * ' + env.docs_dir)

def sync_db(env):
    if env == "local":
        local("python manage.py syncdb --settings=settings.local")
    else:
        virtualenv('python manage.py syncdb --settings=settings.production')
    
def migrate(env):
    if env == "local":
        local("python manage.py migrate --settings=settings.local")
    else:
        virtualenv('python manage.py migrate --settings=settings.production')
        
def custom_migration(app, migration):
    virtualenv('python manage.py migrate:%s %s --settings=settings.production')

def build_migration(app):
    local("python manage.py schemamigration %s --auto --settings=settings.local" % app)
 
def make_release(tag):
    local("git tag -a %s -m 'version %s'" % (tag, tag))
    local("git push --tags")
    print("Release %s has been made and pushed to github." % tag)

# Remote Commands

    
def view_log():
    run('sudo cat /var/log/apache2/ome-error.log')

def kick_apache():
    run('sudo %s graceful' % env.apache_bin_dir)


def get_code_latest():
    with cd(env.directory):
        run('git pull origin %s' % env.git_production_branch)
        
def get_code_release(tag):
    with cd(env.directory):
        run('git fetch --tags')
        run('git checkout %s' % tag)
        
def copy_static(env):
    with cd(env.directory + '/static'):
        run('cp -r * ' + env.static_dir)

# Deployment Commands

def memory():
    run("ps -u %s -o pid,rss,command" % env.deploy_user)

def production(release_tag):
    env.branch = "production"
    env.release_tag = release_tag

def deploy():
    if env.branch == "production":
        get_code_release(release_tag)
    elif env.branch == "alpha":
        get_code_latest()
    pip_install_req(env.branch)
    copy_static(env.branch)
    sync_db(env.branch)
    migrate(env.branch)
    kick_apache()
    # Need to find out what we are going to do to restart.
    print("Deployment completed.")
    
    
