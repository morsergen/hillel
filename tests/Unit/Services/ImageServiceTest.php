<?php

namespace Tests\Unit\Services;

use App\Models\Category;
use App\Models\Product;
use App\Services\ImageService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImageServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var bool
     */
    protected bool $seed = true;

    /**
     * @var ImageService|mixed
     */
    protected ImageService $imageService;

    /**
     * @var Category|Collection|Model|\Illuminate\Support\Collection|mixed
     */
    protected Category $category;

    /**
     * @var Product|Product[]|Builder[]|Collection|\Illuminate\Support\Collection|mixed
     */
    protected Product $product;

    /**
     * @var array
     */
    protected array $images = [];

    /**
     * @return void
     * @throws BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->imageService = app()->make(ImageService::class);
        $this->category = Category::all()->random();
        $this->product = Product::whereCategoryId($this->category->id)->get()->random();
        $this->images = [
            UploadedFile::fake()->image('test1.jpg'),
            UploadedFile::fake()->image('test2.jpg'),
            UploadedFile::fake()->image('test3.jpg'),
        ];
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws Exception
     */
    public function test_attach_method_with_images()
    {
        $this->imageService->attach($this->product, 'images', $this->images);

        $this->assertEquals(count($this->images), $this->product->images()->count());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws Exception
     */
    public function test_attach_method_with_empty_images()
    {
        $this->imageService->attach($this->product, 'images', []);

        $this->assertEquals(0, $this->product->images()->count());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws Exception
     */
    public function test_attach_method_relation_not_exist()
    {
        $method = 'test_method';

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('#' . $this->product::class . 'doesn\'t nave #' . $method);

        $this->imageService->attach($this->product, $method, []);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws Exception
     */
    public function test_detach_method_with_images()
    {
        $this->imageService->attach($this->product, 'images', $this->images);

        $this->assertEquals(count($this->images), $this->product->images()->count());

        $this->imageService->detach($this->product, 'images');

        $this->assertEquals(0, $this->product->images()->count());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws Exception
     */
    public function test_detach_method_relation_not_exist()
    {
        $method = 'test_method';

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('#' . $this->product::class . 'doesn\'t nave #' . $method);

        $this->imageService->detach($this->product, $method);
    }
}
