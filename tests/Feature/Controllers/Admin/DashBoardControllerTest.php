<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashBoardControllerTest extends TestCase
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
    public function test_access_redirect_to_login_page_if_not_auth_user()
    {
        $response = $this->get(route('admin.home'));

        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_index_page_with_auth_admin_user()
    {
        $role = Role::getAdminRole();
        $user = User::whereRoleId($role->id)->first();

        $response = $this->actingAs($user)->get(route('admin.home'));

        $response->assertOk()->assertSee('Admin Dashboard');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_access_denied_index_page_with_auth_customer_user()
    {
        $role = Role::getCustomerRole();
        $user = User::whereRoleId($role->id)->first();

        $response = $this->actingAs($user)->get(route('admin.home'));

        $response->assertStatus(302)->assertRedirect(route('home'));
    }
}
