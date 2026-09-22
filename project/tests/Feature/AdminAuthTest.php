<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    public function test_guest_is_redirected_to_admin_login_when_visiting_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('Admin Login');
        $response->assertSee('admin@hariomcomputer.com');
    }

    public function test_admin_can_authenticate_using_database_credentials(): void
    {
        $user = User::where('email', 'admin@hariomcomputer.com')->first();
        if (!$user) {
            $this->seed(AdminUserSeeder::class);
            $user = User::where('email', 'admin@hariomcomputer.com')->first();
        }

        $response = $this->post('/admin/login', [
            'email' => 'admin@hariomcomputer.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/admin/dashboard');
    }

    public function test_admin_cannot_authenticate_with_invalid_password(): void
    {
        $response = $this->from('/admin/login')->post('/admin/login', [
            'email' => 'admin@hariomcomputer.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors('email');
    }

    public function test_authenticated_admin_is_redirected_when_visiting_login_page(): void
    {
        $user = User::where('email', 'admin@hariomcomputer.com')->first();
        if (!$user) {
            $this->seed(AdminUserSeeder::class);
            $user = User::where('email', 'admin@hariomcomputer.com')->first();
        }

        $response = $this->actingAs($user)->get('/admin/login');

        $response->assertRedirect('/admin/dashboard');
    }

    public function test_admin_can_logout(): void
    {
        $user = User::where('email', 'admin@hariomcomputer.com')->first();
        if (!$user) {
            $this->seed(AdminUserSeeder::class);
            $user = User::where('email', 'admin@hariomcomputer.com')->first();
        }

        $response = $this->actingAs($user)->post('/admin/logout');

        $this->assertGuest();
        $response->assertRedirect('/admin/login');
    }

    public function test_seeder_creates_only_admin_user(): void
    {
        $this->seed(DatabaseSeeder::class);

        $admin = User::where('email', 'admin@hariomcomputer.com')->first();
        $this->assertNotNull($admin);
        $this->assertTrue(Hash::check('password', $admin->password));
    }
}
