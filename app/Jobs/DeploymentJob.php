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
        Log::info('dumping IP');
        Log::debug(request()->getClientIp());

        Log::info('dumping webhook call');
        Log::info(json_encode($this->webhookCall));
    }
}
