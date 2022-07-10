@setup
    use \Illuminate\Support\Facades\Log;

    $homeDirectory = '~/';
    $projectDirectory = 'webhooks';
    $branch = 'main';

    Log::info('Inside Envoy setup method');
@endsetup

@task('deploy-staging')
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
