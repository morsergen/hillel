<?php

namespace App\Services\Contracts;

interface AwsPublicLinkInterface
{
    public function generateUri(string $filePath): string;
}
