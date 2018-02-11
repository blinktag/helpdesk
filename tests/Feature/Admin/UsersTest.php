<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_cannot_access_users()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $this->get('/admin/users/')
             ->assertRedirect('/admin/login');
    }

    /** @test */
    public function admin_can_view_users()
    {
        $user = factory(\App\User::class)->create();

        $this->signInAdmin();

        $this->get('/admin/users/')
             ->assertSee($user->name);
    }

    /** @test */
    public function view_user_profile()
    {
        $user = factory(\App\User::class)->create();

        $this->signInAdmin();

        $this->get("/admin/users/{$user->id}")
             ->assertSee($user->name);
    }

    /** @test */
    public function update_user_profile()
    {
        $user = factory(\App\User::class)->create();

        $this->signInAdmin();

        $post_data = ['name' => 'John Smith', 'email' => 'john@smith.net'];

        $this->put("/admin/users/{$user->id}", $post_data)
             ->assertStatus(302);

        $this->assertSame('John Smith', $user->fresh()->name);
        $this->assertSame('john@smith.net', $user->fresh()->email);
    }

}
