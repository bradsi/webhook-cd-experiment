<?php

namespace App\Http;

use Illuminate\Http\Request;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

class DeploymentValidator implements SignatureValidator
{

//    private array $ipAddresses = [
//    ];

    public function isValid(Request $request, WebhookConfig $config): bool
    {
        return true;
    }
}
