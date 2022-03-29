<?php

namespace Tests\Feature\Controllers\Ajax;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Services\ImageService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DeleteImageControllerTest extends TestCase
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
     * @var Role
     */
    protected Role $role;

    /**
     * @var User
     */
    protected User $user;

    /**
     * @return void
     * @throws BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->role = Role::getAdminRole();
        $this->user = User::whereRoleId($this->role->id)->first();
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
    public function test_delete_images_success()
    {
        $this->imageService->attach($this->product, 'images', $this->images);

        $countImages = $this->product->images()->count();

        foreach ($this->product->images as $image) {
            $response = $this->actingAs($this->user)
                ->delete(
                    route('ajax.image.delete', parameters: ['image' => $image], absolute: false)
                );

            $response->assertJson(['message' => 'Image deleted successfully']);
            $this->assertEquals(--$countImages, $this->product->images()->count());
        }

        $this->assertEquals(0, $this->product->images()->count());
    }
}
