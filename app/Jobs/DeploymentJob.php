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

class DeploymentJob extends ProcessWebhookJob
{
    public function handle()
    {
        // test push on staging now
        Log::info('Hit DeploymentJob');

        if (config('app.env') === 'staging') {
            Log::info('Running staging deployment script');
            $output = [];
            exec('php vendor/bin/envoy run deploy-staging 2>&1', $output);
            dump($output);
        }

        Log::info('Finished DeploymentJob');
    }
}
