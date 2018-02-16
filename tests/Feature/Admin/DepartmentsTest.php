<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Department;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DepartmentsTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function user_cannot_access_department_controller()
    {
        $this->withExceptionHandling();
        $this->signIn();
        $this->get('/admin/departments')
             ->assertRedirect('/admin/login');

    }

    /** @test */
    public function admin_can_create_department()
    {
        $this->signInAdmin();
        $this->post('/admin/departments', ['name' => 'Test Dept'])
             ->assertRedirect('/admin/departments');
        $this->assertDatabaseHas('departments', ['name' => 'Test Dept']);
    }

    /** @test */
    public function admin_can_update_department()
    {
        $department = factory(Department::class)->create();

        $this->signInAdmin();

        $this->put("/admin/departments/{$department->id}", ['name' => 'New Department Name'])
             ->assertRedirect('/admin/departments');

        $this->assertDatabaseHas('departments', ['name' => 'New Department Name']);
    }

     /** @test */
     public function admin_can_delete_department()
     {
         $department = factory(Department::class)->create();

         $this->signInAdmin();

         $this->delete("/admin/departments/{$department->id}")
              ->assertRedirect('/admin/departments');

         $this->assertDatabaseMissing('departments', ['name' => $department->name]);
     }
}
