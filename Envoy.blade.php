@setup
    $homeDirectory = '~/';
    $projectDirectory = 'webhooks';
    $branch = 'main';

function logInfo($message) { return "echo '\033[36m" .$message. "\033[0m';\n"; }
function logSuccess($message) { return "echo '\033[32m" .$message. "\033[0m';\n"; }
function logWarn($message) { return "echo '\033[31m" .$message. "\033[0m';\n"; }
function logLine($message) { return "echo '" .$message. "';\n"; }
@endsetup

@before
    {{ logInfo('Running Envoy deployment script') }}
@endbefore

@task('deploy-staging')
    cd {{ $homeDirectory.$projectDirectory }}
    git pull origin {{ $branch }}
    php artisan migrate --force
@endtask

@error
    {{ logWarn('Envoy deployment script ran into an error') }}
@enderror

@success
    {{ logSuccess('Successfully deployed.') }}
@endsuccess

@finished
    {{ logLine('Envoy deployment script finished') }}
@endfinished
