<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:cneukom/qrbill-scanner-poc.git');
set('git_ssh_command', 'ssh -o StrictHostKeyChecking=yes');
set('bin/php', '/usr/local/bin/php82');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

import('servers.yaml');

// Tasks

task('deploy:writable', function () {
    // deploy:writeable not needed
});

task('frontend:build', function () {
    runLocally('yarn prod');
});

task('frontend:upload', function () {
    $directory = 'public';
    $manifest = $directory . '/mix-manifest.json';
    $files = json_decode(file_get_contents($manifest));

    foreach ($files as $file => $version) {
        // attempt to create the directory, but fail silently if it already exists
        run('mkdir -p \'{{release_path}}/\'' . escapeshellarg($directory . dirname($file)));

        upload($directory . $file, '{{release_path}}/' . $directory . $file);
    }
    upload($manifest, '{{release_path}}/' . $directory);
});

// Hooks

after('deploy:failed', 'deploy:unlock');
after('deploy:update_code', 'frontend:build');
after('frontend:build', 'frontend:upload');
