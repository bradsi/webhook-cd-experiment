@setup
    $homeDirectory = '~/';
    $projectDirectory = 'webhooks';
    $branch = 'main';

    echo "Inside Envoy setup";
@endsetup

@before
    echo "Running Envoy deployment script, standard echo output"
@endbefore

@task('deploy-staging')
    cd {{ $homeDirectory.$projectDirectory }}
    git pull origin {{ $branch }}
    php artisan migrate --force
@endtask

@error
    echo "Envoy deployment script ran into an error"
@enderror

@success
    echo "Successfully deployed"
@endsuccess

@finished
    echo "Envoy deployment script finished"
@endfinished
