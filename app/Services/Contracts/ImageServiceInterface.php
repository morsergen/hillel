<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ImageServiceInterface
{
    public function sync(Model $model, string $methodName, array $images = []);
}
