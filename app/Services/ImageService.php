<?php

namespace App\Services;

use App\Services\Contracts\ImageServiceInterface;
use Illuminate\Database\Eloquent\Model;

class ImageService implements ImageServiceInterface
{
    public function sync(Model $model, string $methodName, array $images = [])
    {
        if (!method_exists($model, $methodName)) {
            throw new \Exception('#' . $model::class . 'doesn\'t nave #' . $methodName);
        }

        foreach ($model->$methodName as $image) {
            FileUploadService::remove($image->path);
            $model->$methodName()->delete(['path' => $image]);
        }

        foreach ($images as $image) {
            $model->$methodName()->create(['path' => $image]);
        }
    }
}
