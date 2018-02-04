<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\CreateResponse;
use App\Http\Requests\StoreNewTicket;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateResponseTest extends TestCase
{

    use DatabaseMigrations;
    
    protected $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = new CreateResponse();
    }

    /** @test */
    public function make_creates_a_response()
    {
        $user = factory(\App\User::class)->create();
        $department = factory(\App\Department::class)->create();
        $ticket = factory(\App\Ticket::class)->create(['user_id' => $user->id, 'department_id' => $department->id]);
        $this->actingAs($user);

        $request = new StoreNewTicket();
        $request->setContainer($this->app);
        $request->initialize([], [
            'body' => 'New Response!',
            'subject' => 'New Ticket!'
        ]);

        $response = $this->service->make($request, $ticket);
        $this->assertInstanceOf(\App\Response::class, $response);
        $this->assertSame('New Response!', $response->content);
    }
}
