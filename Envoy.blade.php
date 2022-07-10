@servers(['main' => 'localhost'])

@setup
    $homeDirectory = '/var/www/';
    $projectDirectory = 'staging.jamsoup.com';
    $branch = 'main';
@endsetup

@task('deploy-staging', ['on' => 'main'])
    echo 'Testing echo from deploy-staging'
    pwd
    cd {{ $homeDirectory.$projectDirectory }}
    pwd
    git pull origin {{ $branch }}
    php artisan migrate --force
@endtask

@task('deploy-local', ['on' => 'main'])
    echo "Testing log output inside deploy-local task"
@endtask

@task('test', ['on' => 'main'])
    cd /home/vagrant/webhook-cd-test
    ls -l
@endtask

{{--@before--}}
{{--    {{ logger('Running Envoy deployment script') }}--}}
{{--@endbefore--}}

{{--@error--}}
{{--    {{ logger('Envoy deployment script ran into an error') }}--}}
{{--@enderror--}}

{{--@success--}}
{{--    {{ logger('Successfully deployed') }}--}}
{{--@endsuccess--}}

{{--@finished--}}
{{--    {{ logger('Envoy deployment script finished') }}--}}
{{--@endfinished--}}
