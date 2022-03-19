<?php

namespace App\Services;

use App\Services\Contracts\ImageServiceInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService implements ImageServiceInterface
{
    public static function upload($image): string
    {
        if (is_null($image)) {
            return '';
        }

        if ($isString = is_string($image)) {
            $imageData = explode('.', $image);
        }

        $imagePath = implode('/', str_split(Str::random(8), 2))
            . '/'
            . Str::random()
            . '.' . (!$isString ? $image->getClientOriginalExtension() : $imageData[1]);

        Storage::put('public/' . $imagePath, File::get($image));

        return $imagePath;
    }

    public static function remove($image)
    {
        Storage::delete($image);
    }
}
