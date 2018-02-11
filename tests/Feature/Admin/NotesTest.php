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

    /** @test */
    public function admin_can_create_note()
    {
        $admin = factory(\App\Admin::class)->create();
        $ticket = factory(\App\Ticket::class)->create();
        $this->signInAdmin($admin);

        $note_data = [
            'ticket_id' => $ticket->id,
            'content'   => 'Please update user by 3pm',
            'priority'  => 'medium'
        ];

        $this->post("/admin/notes/", $note_data)
             ->assertStatus(201);

        $this->assertDatabaseHas('notes', $note_data);
    }

    /** @test */
    public function admin_can_update_note()
    {
        $admin = factory(\App\Admin::class)->create();
        $ticket = factory(\App\Ticket::class)->create();
        $note = factory(\App\Note::class)->create(['ticket_id' => $ticket->id, 'admin_id' => $admin->id]);
        $this->signInAdmin($admin);

        $this->put("/admin/notes/{$note->id}", ['content' => 'New Content', 'priority' => 'high'])
             ->assertJson(['data' => ['content' => 'New Content', 'priority' => 'high']]);
    }

    public function admin_can_delete_note()
    {
        $admin = factory(\App\Admin::class)->create();
        $ticket = factory(\App\Ticket::class)->create();
        $note = factory(\App\Note::class)->create(['ticket_id' => $ticket->id, 'admin_id' => $admin->id]);
        $this->signInAdmin($admin);
        $this->delete("/admin/notes/{$note->id}")
             ->assertStatus(200);
    }
}
