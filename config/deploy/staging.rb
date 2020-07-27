############################################
# Setup Server
############################################

set :stage, :staging
set :stage_url, "https://rablackford.jimchestnutt.co.uk"
server "cerberus.jimchestnutt.co.uk", user: "rablackford", roles: %w{web app db}
set :deploy_to, "/sites/rablackford.jimchestnutt.co.uk/files"

# The web user on this environment's server.
set :web_user, 'rablackford'

############################################
# Setup Git
############################################

set :branch, "development"

############################################
# Extra Settings
############################################

#specify extra ssh options:

#set :ssh_options, {
#    auth_methods: %w(password),
#    password: 'password',
#    user: 'username',
#}

#specify a specific temp dir if user is jailed to home
#set :tmp_dir, "/path/to/custom/tmp"
