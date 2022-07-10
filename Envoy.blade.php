@setup
    $homeDirectory = '~/';
    $projectDirectory = 'webhooks';
    $branch = 'main';

    logger('Inside Envoy setup method');
@endsetup

@before
    {{ logger('Running Envoy deployment script') }}
@endbefore

@task('deploy-staging')
    cd {{ $homeDirectory.$projectDirectory }}
    git pull origin {{ $branch }}
    php artisan migrate --force
@endtask

@error
    {{ logger('Envoy deployment script ran into an error') }}
@enderror

@success
    {{ logger('Successfully deployed') }}
@endsuccess

@finished
    {{ logger('Envoy deployment script finished') }}
@endfinished
