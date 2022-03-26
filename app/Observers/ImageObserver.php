<?php

namespace App\Observers;

use App\Models\Image;
use App\Services\FileUploadService;

class ImageObserver
{
    /**
     * Handle the Image "created" event.
     *
     * @param Image $image
     * @return void
     */
    public function created(Image $image)
    {
        //
    }

    /**
     * Handle the Image "updated" event.
     *
     * @param Image $image
     * @return void
     */
    public function updated(Image $image)
    {
        //
    }

    /**
     * Handle the Image "deleted" event.
     *
     * @param Image $image
     * @return void
     */
    public function deleted(Image $image)
    {
        FileUploadService::remove($image->path);
    }

    /**
     * Handle the Image "restored" event.
     *
     * @param Image $image
     * @return void
     */
    public function restored(Image $image)
    {
        //
    }

    /**
     * Handle the Image "force deleted" event.
     *
     * @param Image $image
     * @return void
     */
    public function forceDeleted(Image $image)
    {
        //
    }
}
