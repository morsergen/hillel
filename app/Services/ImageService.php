<?php

namespace App\Services;

use App\Services\Contracts\ImageServiceInterface;
use Illuminate\Database\Eloquent\Model;

class ImageService implements ImageServiceInterface
{
    public function attach(Model $model, string $methodName, array $images = []): void
    {
        if (!method_exists($model, $methodName)) {
            throw new \Exception('#' . $model::class . 'doesn\'t nave #' . $methodName);
        }

        foreach ($images as $image) {
            $model->$methodName()->create(['path' => $image]);
        }
    }

    public function detach(Model $model, string $methodName): void
    {
        if (!method_exists($model, $methodName)) {
            throw new \Exception('#' . $model::class . 'doesn\'t nave #' . $methodName);
        }

        $model->$methodName()->delete();
    }
}
