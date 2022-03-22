<?php

namespace App\Services\Contracts;

interface FileUploadInterface
{
    /**
     * @param $file
     * @return string
     */
    public static function upload($file): string;

    /**
     * @param $file
     */
    public static function remove($file);
}
