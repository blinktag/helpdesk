<?php

namespace Tests\Feature;

use App\User;
use App\Ticket;
use Tests\TestCase;
use App\Department;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TicketsTest extends TestCase
{

    use DatabaseMigrations;
    
    /** @test */
    public function guests_cannot_create_ticket()
    {
        $this->withExceptionHandling();
        
        $this->get('/tickets/create')
             ->assertRedirect('/login');

        $this->post('/tickets')
             ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_create_ticket()
    {
        $this->signIn();
        $department = factory(Department::class)->create();

        $data = [
            'department_id' => $department->id,
            'subject'       => 'Help Me!',
            'body'          => 'My website is down'
        ];
        $this->post('/tickets', $data)
             ->assertStatus(302);

        $this->assertDatabaseHas('tickets', ['subject' => $data['subject']]);
        
    }

    /** @test */
    public function user_can_respond_to_ticket()
    {
        $user = factory(User::class)->create();
        $this->signIn($user);

        $department = factory(Department::class)->create();
        $ticket = factory(Ticket::class)->create([
            'department_id' => $department->id,
            'subject'       => 'Response Test',
            'user_id'       => $user->id
        ]);

        Storage::fake('attachments');

        $data = [
            'ticket_id'  => $ticket->id, 
            'body'       => 'Sample Response', 
            //'ticket_attachment' => UploadedFile::fake()->image('screenshot.jpg')
        ];

        $this->post('/responses', $data)
             ->assertRedirect("/tickets/{$ticket->id}");

        $ticket = $ticket->fresh();
        
        $this->assertDatabaseHas('responses', ['content' => 'Sample Response']);
        $this->assertCount(1, $ticket->responses);
        $this->assertSame(1, $ticket->reply_count);
        //Storage::disk('attachments')->assertExists('screenshot.jpg');
    }
}
