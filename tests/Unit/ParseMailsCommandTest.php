<?php

namespace Tests\Unit;

use App\User;
use App\Pipe;
use App\Ticket;
use App\Response;
use Tests\TestCase;
use PhpImap\IncomingMail;
use App\Console\Commands\ParseMailsCommand;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParseMailsCommandTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * Instance of command
     *
     * @var ParseMailsCommand;
     */
    protected $cmd;

    public function setUp()
    {
        parent::setUp();
        $this->cmd = new ParseMailsCommand();
    }

    /** @test */
    public function parseTicketIdFromSubject()
    {
        $subject = 'No ticket ID in this';
        $this->assertNull($this->cmd->parseTicketIdFromSubject($subject));

        $subject = "Re: [Ticket 435091] This should return a ticket ID";
        $this->assertSame(435091, $this->cmd->parseTicketIdFromSubject($subject));
    }

    /** @test */
    public function createOrFindTicket()
    {
        $pipe = factory(Pipe::class)->make(['department_id' => 1]);
        $user = factory(User::class)->create(['email' => 'test@source.com']);

        $message = $this->_createMessageStub();

        $ticket = $this->cmd->createOrFindTicket($pipe, $user, $message);

        $this->assertInstanceOf(Ticket::class, $ticket);
        $this->assertSame($ticket->subject, 'Help me!');
    }

    /** @test */
    public function createResponseToTicket()
    {
        $user = factory(User::class)->create(['email' => 'test@source.com']);
        $ticket = factory(Ticket::class)->create(['user_id' => $user->id]);


        $message = $this->_createMessageStub();
        $response = $this->cmd->createResponseToTicket($ticket, $message);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame($response->ticket_id, $ticket->id);
    }

    private function _createMessageStub(): IncomingMail
    {
        $message = new IncomingMail();
        $message->fromAddress = 'test@source.com';
        $message->subject = 'Help me!';
        $message->textPlain = 'My site is down!';

        return $message;
    }
}
