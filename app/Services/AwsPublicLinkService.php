<?php

namespace App\Services;

use App\Services\Contracts\AwsPublicLinkInterface;
use Illuminate\Support\Facades\Storage;

class AwsPublicLinkService implements AwsPublicLinkInterface
{
    public function generateUri(string $filePath): string
    {
        try {
            $s3 = Storage::disk('s3')->getClient();
            $cmd = $s3->getCommand('GetObject', [
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key' => $filePath,
                'ACL' => 'public-read'
            ]);

            $request = $s3->createPresignedRequest($cmd, "+7 days");

            return (string) $request->getUri();
        } catch (\Exception $exception) {
            logs()->warning(self::class . ' => ' . $exception->getMessage());
        }

        return '';
    }
}
