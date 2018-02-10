<?php

namespace Tests\Feature\Admin;

use App\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotesTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function user_cannot_access_notes()
    {
        $this->withExceptionHandling();

        $admin = factory(\App\Admin::class)->create();

        $this->signIn();

        $this->get('/admin/notes/1')
             ->assertRedirect('/admin/login');
    }

    /** @test */
    public function admin_can_view_note()
    {
        $admin = factory(\App\Admin::class)->create();
        $this->signInAdmin($admin);

        $note = Note::create([
            'ticket_id' => 1,
            'admin_id'  => $admin->id,
            'content'   => 'This conversation was easy'
        ]);

        $this->get('/admin/notes/1')
             ->assertJson([]);
    }
}
