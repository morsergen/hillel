<?php

namespace App\Services\Contracts;

interface ImageServiceInterface
{
    /**
     * @param $image
     * @return string
     */
    public static function upload($image): string;

    /**
     * @param $image
     */
    public static function remove($image);
}
