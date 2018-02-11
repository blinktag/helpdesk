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

}
