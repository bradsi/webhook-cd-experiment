<?php

namespace App\Http;

use Illuminate\Http\Request;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

class DeploymentValidator implements SignatureValidator
{

//    private array $ipAddresses = [
//    ];

// envoy is available here
// php vendor/bin/envoy
// Test push
// Test push on staging!

    public function isValid(Request $request, WebhookConfig $config): bool
    {
        return true;
    }
}
