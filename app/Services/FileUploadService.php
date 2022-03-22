<?php

namespace App\Services;

use App\Services\Contracts\FileUploadInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService implements FileUploadInterface
{
    public static function upload($file): string
    {
        if (is_null($file)) {
            return '';
        }

        if ($isString = is_string($file)) {
            $imageData = explode('.', $file);
        }

        $imagePath = implode('/', str_split(Str::random(8), 2))
            . '/'
            . Str::random()
            . '.' . (!$isString ? $file->getClientOriginalExtension() : $imageData[1]);

        Storage::put('public/' . $imagePath, File::get($file));

        return $imagePath;
    }

    public static function remove($file)
    {
        Storage::disk('public')->delete($file);
    }
}
