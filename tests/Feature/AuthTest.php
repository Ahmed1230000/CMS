<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create(
            [
                'email' => 'ahmed@example.com',
                'password' => Hash::make('password'),
            ]
        );

        Livewire::test('pages::auth.login')
            ->set('email', 'ahmed@example.com')
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_wrong_password(): void
    {
        $user = User::factory()->create(
            [
                'email' => 'ahmed@example.com',
                'password' => Hash::make('password'),
            ]
        );

        Livewire::test('pages::auth.login')
            ->set('email', 'ahmed@example.com')
            ->set('password', 'worng-password')
            ->call('login');

        $this->assertGuest();
    }

    public function test_user_cannot_login_with_wrong_email(): void
    {
        User::factory()->create([
            'email' => 'ahmed@example.com',
            'password' => Hash::make('password'),
        ]);

        Livewire::test('pages::auth.login')
            ->set('email', 'wrong@example.com')
            ->set('password', 'password')
            ->call('login');

        $this->assertGuest();
    }

    public function test_user_cannot_login_without_email(): void
    {
        User::factory()->create([
            'email' => 'ahmed@example.com',
            'password' => Hash::make('password'),
        ]);

        Livewire::test('pages::auth.login')
            ->set('email', '')
            ->set('password', 'password')
            ->call('login')
            ->assertHasErrors(['email']);

        $this->assertGuest();
    }
    public function test_user_cannot_login_without_password(): void
    {
        User::factory()->create([
            'email' => 'ahmed@example.com',
            'password' => Hash::make('password'),
        ]);

        Livewire::test('pages::auth.login')
            ->set('email', 'ahmed@example.com')
            ->set('password', '')
            ->call('login')
            ->assertHasErrors(['password']);

        $this->assertGuest();
    }
    public function test_user_cannot_login_with_invalid_email_format(): void
    {
        Livewire::test('pages::auth.login')
            ->set('email', 'ahmed')
            ->set('password', 'password')
            ->call('login')
            ->assertHasErrors(['email']);

        $this->assertGuest();
    }
}
