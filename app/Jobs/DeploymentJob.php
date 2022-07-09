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
        Log::info('Hit DeploymentJob');

        if (config('app.env') === 'staging') {
            Log::info('Running staging deployment script');
            exec('php vendor/bin/envoy run deploy-staging');
        }

        Log::info('Finished DeploymentJob');
    }
}
