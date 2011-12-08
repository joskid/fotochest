env.webteam_dir = '/srv/www/projects'
env.id = PROJECT_ID
env.user = PROJECT_USER
env.directory = env.webteam_dir + '/%s' % PROJECT_ID
env.virtual_dir = '/srv/www/.virtualenvs'
env.static_dir = '/srv/www/static/%s' % PROJECT_ID
env.project_virtual = '/srv/www/.virtualenvs/%s' % PROJECT_ID
env.activate = 'source /srv/www/.virtualenvs/%s/bin/activate' % PROJECT_ID
env.git_repo = "git@github.com:kstateome/%s.git" % PROJECT_ID
env.apache_bin_dir = "/etc/init.d/apache2"
env.log_location = "/var/log/apache2/ome-error.log"
env.git_production_branch = "production"

from hadrian.conf.fab import *