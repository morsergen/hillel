<?php

namespace Tests\Feature\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var bool
     */
    protected bool $seed = true;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page_with_auth_admin_user()
    {
        $role = Role::getAdminRole();
        $user = User::whereRoleId($role->id)->first();

        $response = $this->actingAs($user)->get(route('home'));

        $response->assertOk()->assertSee('Logout');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page_with_auth_customer_user()
    {
        $role = Role::getCustomerRole();
        $user = User::whereRoleId($role->id)->first();

        $response = $this->actingAs($user)->get(route('home'));

        $response->assertOk()->assertSee('Logout');
    }
}
