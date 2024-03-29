<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config
set('repository', 'git@github.com:sabinks/beautiful-quotes.git');

set('branch', 'master');
set('release_name', function () {
    return date('YmdHis');
});
set('keep_releases', 1);
add('shared_files', ['.env', '.env.example']);
add('shared_dirs', ['public/uploads']);

// Writable dirs by web server
add('writable_dirs', ['public/uploads', 'storage', 'storage/framework', 'bootstrap/cache']);

// Hosts
host('quote_buckets')
    ->set('labels', ['stage' => 'production'])
    ->set('remote_user', 'root')
    ->set('deploy_path', '/var/www/quote-buckets/live/backend');

// Hooks
after('deploy:failed', 'deploy:unlock');
task('config-cache:clear', function () {
    run('cd {{release_path}} && php artisan config:clear && php artisan cache:clear');
});

task('reload:php-fpm', function () {
    run('sudo systemctl reload php8.1-fpm');
});

task('reload:nginx', function () {
    run('sudo systemctl reload nginx');
});
after('deploy', 'config-cache:clear');
after('deploy', 'reload:php-fpm');
