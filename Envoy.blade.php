@servers(['main' => 'localhost'])

@setup
    $homeDirectory = '~/';
    $projectDirectory = 'webhooks';
    $branch = 'main';
@endsetup

@task('deploy-staging', ['on' => 'main'])
    echo 'Testing echo from deploy-staging'
    {{ 'testing blade echo from deploy-staging' }}
    cd {{ $homeDirectory.$projectDirectory }}
    git pull origin {{ $branch }}
    php artisan migrate --force
@endtask

@task('deploy-local', ['on' => 'main'])
    echo "Testing log output inside deploy-local task"
    {{ 'Testing log output inside deploy-local task via blade syntax' }}
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
