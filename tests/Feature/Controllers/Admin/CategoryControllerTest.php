<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
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
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->role = Role::getAdminRole();
        $this->user = User::whereRoleId($this->role->id)->first();
        $this->category = Category::all()->random();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_redirect_to_login_page_if_not_auth_user()
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_categories_admin_page_with_auth_admin_user()
    {
        $response = $this->actingAs($this->user)->get(route('admin.categories.index'));

        $response->assertOk()->assertSee('Categories');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_show_category_admin_page_with_auth_admin_user()
    {
        $response = $this->actingAs($this->user)->get(route('admin.categories.show', ['category' => $this->category]));

        $response->assertOk()->assertSee(['Category', 'ID', 'Name', 'Slug', 'Description']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_edit_category_admin_page_with_auth_admin_user()
    {
        $response = $this->actingAs($this->user)->get(route('admin.categories.edit', ['category' => $this->category]));

        $response->assertOk()->assertSee(['Edit category', 'Name', 'Thumbnail', 'Description']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_create_category_admin_page_with_auth_admin_user()
    {
        $response = $this->actingAs($this->user)->get(route('admin.categories.create'));

        $response->assertOk()->assertSee(['Create category', 'Name', 'Thumbnail', 'Description']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_category_admin_page_with_auth_admin_user()
    {
        $categoryData =$this->getCategoryData();

        $countCategories = Category::all()->count();

        $response = $this->actingAs($this->user)
            ->post(route('admin.categories.store', absolute: false), $categoryData);

        $this->assertEquals($countCategories + 1, Category::all()->count());

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('success', __('Category created successfully'));

        $category = Category::all()->last();
        $this->assertEquals('Test category', $category->name);
        $this->assertEquals('Test description', $category->description);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_category_admin_page_with_auth_admin_user()
    {
        $categoryData = $this->getCategoryData();

        $this->actingAs($this->user)
            ->post(route('admin.categories.store', absolute: false), $categoryData);

        $category = Category::all()->last();
        $category->name = 'Test category update';
        $category->description = 'Test description update';
        unset($category->thumbnail);

        $response = $this->actingAs($this->user)
            ->put(
                route('admin.categories.update', parameters: ['category' => $category], absolute: false),
                $category->toArray()
            );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('success', __('Category updated successfully'));

        $product = Category::all()->last();
        $this->assertEquals('Test category update', $product->name);
        $this->assertEquals('Test description update', $product->description);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_category_admin_page_with_auth_admin_user()
    {
        $categoryData = $this->getCategoryData();

        $this->actingAs($this->user)
            ->post(route('admin.categories.store', absolute: false), $categoryData);

        $category = Category::all()->last();

        $response = $this->actingAs($this->user)
            ->delete(
                route('admin.categories.destroy', parameters: ['category' => $category], absolute: false)
            );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('success', __('Category deleted successfully'));

        $this->assertNull(Category::find($category->id));
    }

    /**
     * @return array
     */
    private function getCategoryData()
    {
        return [
            'name' => 'Test category',
            'description' => 'Test description',
            'thumbnail' => UploadedFile::fake()->image('file.jpg')
        ];
    }

}
