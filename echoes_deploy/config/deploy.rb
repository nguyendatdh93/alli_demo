# config valid only for current version of Capistrano
lock '3.6.1'

set :application, 'webapp'
set :repo_url, 'git@git.aa-dev.com:aainc/echoes-act2.git'

# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp
ask :branch, 'master'

# Default deploy_to directory is /var/www/my_app_name
# set :deploy_to, '/var/www/my_app_name'
set :deploy_to, -> { "/var/www/#{fetch(:application)}" }

# Default value for :scm is :git
# set :scm, :git
set :scm, :gitcopy

# Default value for :format is :airbrussh.
# set :format, :airbrussh

# You can configure the Airbrussh format using :format_options.
# These are the defaults.
# set :format_options, command_output: true, log_file: 'log/capistrano.log', color: :auto, truncate: :auto

# Default value for :pty is false
set :pty, true

# Default value for :linked_files is []
# append :linked_files, 'config/database.yml', 'config/secrets.yml'

# Default value for linked_dirs is []
# append :linked_dirs, 'log', 'tmp/pids', 'tmp/cache', 'tmp/sockets', 'public/system'
set :linked_dirs, %w(storage vendor)

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
set :keep_releases, 5

namespace :deploy do

  desc 'refresh cache'
  task :refresh_cache do
    on roles(:web) do
      execute "curl http://localhost/cc.php"
    end
  end
  after :published, :refresh_cache

  desc 'refresh process'
  task :refresh_process do
    on roles(:web) do
      execute "sudo /bin/systemctl reload php-fpm"
      execute "php /var/www/webapp/current/artisan horizon:terminate"
    end
  end

  after :updated, :update_library do
    desc 'update vendor'
    on roles(:web) do
      execute "composer --working-dir=#{release_path} install"
      execute "composer --working-dir=#{release_path} dumpautoload"
      execute "cp #{release_path}/.env.#{fetch(:stage)} #{release_path}/.env"
      execute "php #{release_path}/artisan cache:clear"
      execute "php #{release_path}/artisan config:clear"
      execute "php #{release_path}/artisan clear-compiled"
      execute "php #{release_path}/artisan view:clear"
      execute "php #{release_path}/artisan migrate --force"
      execute "chmod -R 777 #{release_path}/storage"
    end
  end

  desc 'echo_path'
  task :echo_path do
    on roles(:web) do
      last_release = capture(:ls, "-xt", releases_path).split.first
      last_release_path = releases_path.join(last_release)
      execute "echo #{last_release_path}"
      execute "echo #{release_path}"
      execute "echo #{shared_path}"
    end
  end

end
