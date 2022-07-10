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
        // test push on staging now
        Log::info('Hit DeploymentJob');

        if (config('app.env') === 'staging') {
            Log::info('Running staging deployment script');
            exec('php vendor/bin/envoy run deploy-staging');

            Log::info('trying with process command');

            $process = new Process(['php vendor/bin/envoy run deploy-staging']);
            $process->run(function ($type, $buffer) {
                Log::info('Envoy: ' . $buffer);
            });
        }

        if (config('app.env') === 'local') {
            Log::info('Running local script');

            exec('php vendor/bin/envoy run deploy-local');


//            $process = new Process(['php vendor/bin/envoy run deploy-local']);
//            $process = new Process(['pwd'], '/home/vagrant/webhook-cd-test');

            // pwd = /home/vagrant/webhook-cd-test/public
//            $process = new Process(['pwd']);

//            $process = new Process(['pwd']);

//            $process->setWorkingDirectory('/home/vagrant/webhook-cd-test');

//            $process->run(function ($type, $buffer) {
//                Log::info('Envoy: ' . $buffer);
//            });
        }

        Log::info('Finished DeploymentJob');
    }
}
