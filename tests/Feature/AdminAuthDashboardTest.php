<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AdminAuthDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function createAdminUser(array $overrides = []): Admin
    {
        return Admin::create(array_merge([
            'name' => 'Admin Tester',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ], $overrides));
    }

    public function test_admin_login_page_accessible_for_guest()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }

    public function test_admin_can_login_and_redirect_to_dashboard()
    {
        $admin = $this->createAdminUser();

        $response = $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_admin_dashboard_requires_authentication()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/admin/login');
    }

    public function test_authenticated_admin_can_view_dashboard()
    {
        $admin = $this->createAdminUser();
        $this->be($admin, 'admin');

        $response = $this->get('/admin/dashboard');
        $response->assertStatus(200);
    }
}



