<?php

namespace Tests\Unit\Services;

use App\Services\FileUploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_upload_file_to_storage()
    {
        $filePath = FileUploadService::upload(
            UploadedFile::fake()->image('file.jpg')
        );

        $this->assertNotEmpty($filePath);
        $this->assertFileExists(Storage::disk('public')->path($filePath));

        FileUploadService::remove($filePath);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_upload_file_is_null_to_storage()
    {
        $filePath = FileUploadService::upload(null);

        $this->assertEmpty($filePath);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_remove_file_from_storage()
    {
        $filePath = FileUploadService::upload(
            UploadedFile::fake()->image('file.jpg')
        );

        $this->assertNotEmpty($filePath);
        $this->assertFileExists(Storage::disk('public')->path($filePath));

        FileUploadService::remove($filePath);

        $this->assertFileDoesNotExist($filePath);
    }
}
