<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ImageServiceInterface
{
    /**
     * @param Model $model
     * @param string $methodName
     * @param array $images
     * @return void
     */
    public function attach(Model $model, string $methodName, array $images = []): void;

    /**
     * @param Model $model
     * @param string $methodName
     * @return void
     */
    public function detach(Model $model, string $methodName): void;
}
