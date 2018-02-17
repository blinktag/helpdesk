<?php

namespace Tests\Feature\Admin;

use App\Pipe;
use Tests\TestCase;
use App\Department;
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

    /** @test */
    public function admin_can_create_pipe()
    {
        $department = factory(Department::class)->create();
        $pipe = factory(Pipe::class)->make(['department_id' => $department->id]);

        $this->signInAdmin();
        $this->post('/admin/pipes', $pipe->toArray())
                ->assertRedirect('/admin/pipes');

        $this->assertDatabaseHas('pipes', ['username' => $pipe->username]);
    }

    /** @test */
    public function admin_can_edit_pipe()
    {
        $department = factory(Department::class)->create();
        $pipe = factory(Pipe::class)->create(['department_id' => $department->id]);

        $new_data = $pipe->toArray();
        $new_data['server'] = 'mail.shouldexist.net';

        $this->signInAdmin();
        $this->put("/admin/pipes/{$pipe->id}", $new_data)
                ->assertRedirect('/admin/pipes');

        $this->assertDatabaseHas('pipes', ['server' => $new_data['server']]);
    }
}
