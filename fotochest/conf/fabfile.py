from fabric.api import *
env.webteam_dir = '/srv/www/projects'
env.id = "something"
env.user = "something"
env.directory = env.webteam_dir + '/%s' % ""
env.virtual_dir = '/srv/www/.virtualenvs'
env.static_dir = '/srv/www/static/%s' % "lksdjf"
env.project_virtual = '/srv/www/.virtualenvs/%s' % "lkdj"
env.activate = 'source /srv/www/.virtualenvs/%s/bin/activate' % "lksdj"
env.git_repo = "git@github.com:kstateome/%s.git" % "lksdj"
env.apache_bin_dir = "/etc/init.d/apache2"
env.log_location = "/var/log/apache2/ome-error.log"
env.git_production_branch = "production"

from hadrian.conf.fab import *