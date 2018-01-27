<?php

namespace Tests\Unit;

use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketTest extends TestCase
{

    use DatabaseMigrations;

    protected $ticket;

    public function setUp()
    {
        parent::setUp();
        $this->ticket = factory(Ticket::class)->create();
    }

    /** @test */
    public function ticket_belongsto_user()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->ticket->user());
    }

    /** @test */
    public function ticket_belongsto_department()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->ticket->department());
    }

    /** @test */
    public function ticket_hasmany_notes()
    {
        $this->assertInstanceOf(HasMany::class, $this->ticket->notes());
    }

    /** @test */
    public function ticket_hasmany_responses()
    {
        $this->assertInstanceOf(HasMany::class, $this->ticket->responses());
    }
    
}
