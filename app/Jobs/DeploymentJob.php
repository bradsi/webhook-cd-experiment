<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use Symfony\Component\Process\Process;

class DeploymentJob extends ProcessWebhookJob
{
    public function handle()
    {
        Log::info('Hit DeploymentJob');

        if (config('app.env') === 'staging') {
            Log::info('Running staging deployment script');
            Log::info('trying with process command');

            $process = new Process(['php', 'vendor/bin/envoy', 'run', 'deploy-staging'], '/var/www/staging.jamsoup.com');
            $process->run(function ($type, $buffer) {
                Log::info('Envoy: ' . $buffer);
            });
        }

        if (config('app.env') === 'local') {
            Log::info('Running local script');

            $process = new Process(['php', 'vendor/bin/envoy', 'run', 'deploy-local']);
            $process->run(function ($type, $buffer) {
                Log::info('Envoy: ' . $buffer);
            });
        }

        Log::info('Finished DeploymentJob');
    }
}
