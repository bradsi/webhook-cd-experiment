@setup
    $homeDirectory = '~/';
    $projectDirectory = 'webhooks';
    $branch = 'main';
@endsetup

@task('deploy-staging')
    echo 'Testing echo from deploy-staging'
    {{ 'testing blade echo from deploy-staging' }}
    cd {{ $homeDirectory.$projectDirectory }}
    git pull origin {{ $branch }}
    php artisan migrate --force
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
