<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PipesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_cannot_access_pipe_controller()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $this->get('/admin/pipes')
             ->assertRedirect('/admin/login');
    }

    /** @test */
    public function admin_can_list_pipes()
    {
        $this->signInAdmin();
        $this->get('/admin/pipes')
             ->assertStatus(200);
    }
}
