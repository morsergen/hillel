<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var bool
     */
    protected bool $seed = true;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->role = Role::getAdminRole();
        $this->user = User::whereRoleId($this->role->id)->first();
    }

    /**
     * @return void
     */
    public function test_get_products(): void
    {
        $response = $this->actingAs($this->user)->get(route('api.products.index'));
        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('data')->has('meta')->has('links'));
    }

    /**
     * @return void
     */
    public function test_get_product(): void
    {
        $response = $this->actingAs($this->user)->get(route('api.products.show', Product::first()));
        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('data'));
    }
}
