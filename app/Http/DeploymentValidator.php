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
// Didn't have request history enabled on staging, try again
// Test again, didn't have staging db set up

    public function isValid(Request $request, WebhookConfig $config): bool
    {
        return true;
    }
}
