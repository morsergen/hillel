<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var bool
     */
    protected bool $seed = true;

    /**
     * @var Role
     */
    protected Role $role;

    /**
     * @var User
     */
    protected User $user;

    /**
     * @var Category
     */
    protected Category $category;

    /**
     * @var Product
     */
    protected Product $product;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->role = Role::getAdminRole();
        $this->user = User::whereRoleId($this->role->id)->first();
        $this->category = Category::all()->random();
        $this->product = Product::whereCategoryId($this->category->id)->first();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_redirect_to_login_page_if_not_auth_user()
    {
        $response = $this->get(route('admin.products.index'));

        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_products_admin_page_with_auth_admin_user()
    {
        $response = $this->actingAs($this->user)->get(route('admin.products.index'));

        $response->assertOk()->assertSee('Products');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_show_product_admin_page_with_auth_admin_user()
    {
        $response = $this->actingAs($this->user)->get(route('admin.products.show', ['product' => $this->product]));

        $response->assertOk()->assertSee(['Product', 'ID', 'Title', 'Slug', 'Description', 'SKU', 'Price', 'Discount', 'In stock']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_edit_product_admin_page_with_auth_admin_user()
    {
        $response = $this->actingAs($this->user)->get(route('admin.products.edit', ['product' => $this->product]));

        $response->assertOk()->assertSee(['Edit product', 'Title', 'Category', 'Thumbnail', 'Short description', 'Description', 'SKU', 'Price', 'Discount', 'In stock']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_create_product_admin_page_with_auth_admin_user()
    {
        $response = $this->actingAs($this->user)->get(route('admin.products.create'));

        $response->assertOk()->assertSee(['Create product', 'Title', 'Category', 'Thumbnail', 'Short description', 'Description', 'SKU', 'Price', 'Discount', 'In stock']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_product_admin_page_with_auth_admin_user()
    {
        $productData = $this->getProductData();

        $countProducts = Product::all()->count();

        $response = $this->actingAs($this->user)
            ->post(route('admin.products.store', absolute: false), $productData);

        $this->assertEquals($countProducts + 1, Product::all()->count());

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.products.index'))
            ->assertSessionHas('success', __('Product created successfully'));

        $product = Product::all()->last();
        $this->assertEquals('Test product', $product->title);
        $this->assertEquals('Test description', $product->description);
        $this->assertEquals('Test short description', $product->short_description);
        $this->assertEquals('test-sku_345456457645', $product->sku);
        $this->assertEquals(24.7, $product->price);
        $this->assertEquals(42, $product->discount);
        $this->assertEquals(11, $product->in_stock);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_product_admin_page_with_auth_admin_user()
    {
        $productData = $this->getProductData();

        $this->actingAs($this->user)
            ->post(route('admin.products.store', absolute: false), $productData);

        $product = Product::all()->last();
        $product->title = 'Test product update';
        $product->description = 'Test description update';
        unset($product->thumbnail);

        $response = $this->actingAs($this->user)
            ->put(
                route('admin.products.update', parameters: ['product' => $product], absolute: false),
                $product->toArray()
            );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.products.index'))
            ->assertSessionHas('success', __('Product updated successfully'));

        $product = Product::all()->last();
        $this->assertEquals('Test product update', $product->title);
        $this->assertEquals('Test description update', $product->description);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_product_admin_page_with_auth_admin_user()
    {
        $productData = $this->getProductData();

        $this->actingAs($this->user)
            ->post(route('admin.products.store', absolute: false), $productData);

        $product = Product::all()->last();

        $response = $this->actingAs($this->user)
            ->delete(
                route('admin.products.destroy', parameters: ['product' => $product], absolute: false)
            );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.products.index'))
            ->assertSessionHas('success', __('Product deleted successfully'));

        $this->assertNull(Product::find($product->id));
    }

    /**
     * @return array
     */
    private function getProductData(): array
    {
        return [
            'category_id' => $this->category->id,
            'title' => 'Test product',
            'description' => 'Test description',
            'short_description' => 'Test short description',
            'sku' => 'test-sku_345456457645',
            'price' => 24.7,
            'discount' => 42,
            'in_stock' => 11,
            'thumbnail' => UploadedFile::fake()->image('file.jpg')
        ];
    }
}
