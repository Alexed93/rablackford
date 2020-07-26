# Lock the project to Capistrano 3.11.0
lock '3.11.0'

# require Slack config
# require './config/slack'

############################################
# Setup WordPress
############################################

set :wp_user, "alexeddesign@gmail.com" # The admin username
set :wp_email, "alexeddesign@gmail.com" # The admin email address
set :wp_sitename, "RA Blackford" # The site title
set :wp_localurl, "http://rablackford.local" # Your local environment URL

############################################
# Setup project
############################################

set :application, "rablackford"
set :repo_url, "git@github.com:Alexed93/rablackford.git"

################################################################################
## Setup Capistrano
################################################################################

set :log_level, :debug
set :keep_releases, 5
set :use_sudo, false
set :ssh_options, forward_agent: true


################################################################################
## Linked files and directories (symlinks)
################################################################################

set :linked_files, %w(wp-config.php .htaccess robots.txt)
set :linked_dirs, %w(content/uploads)

namespace :deploy do
  desc 'create WordPress files for symlinking'
  task :create_wp_files do
    on roles(:app) do
      execute :touch, "#{shared_path}/wp-config.php"
      execute :touch, "#{shared_path}/.htaccess"
      execute :touch, "#{shared_path}/robots.txt"
    end
  end

  after 'check:make_linked_dirs', :create_wp_files
  after :finishing, 'deploy:cleanup'
end
