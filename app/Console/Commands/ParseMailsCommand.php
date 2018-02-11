<?php

namespace App\Console\Commands;

use App\Pipe;
use App\User;
use App\Ticket;
use App\Response;
use Monolog\Logger;
use PhpImap\Mailbox;
use PhpImap\IncomingMail;
use App\Events\TicketCreated;
use Illuminate\Console\Command;
use Monolog\Handler\StreamHandler;
use App\Events\TicketReplyCreated;

class ParseMailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse all pending incoming e-mails';

    /**
     * Monolog logger instance
     *
     * @var Monolog\Logger
     */
    protected $log;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->log = new Logger('mail_parser');
        $this->log->pushHandler(new StreamHandler('php://output', Logger::INFO));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->log->info('Beginning Processing Run');

        foreach(Pipe::all() as $pipe) {
            $mailbox = new Mailbox($pipe->getMailDSN(), $pipe->username, $pipe->password, __DIR__);
            $mails = $mailbox->searchMailbox('ALL');

            $mail_count = count($mails);
            if ($mail_count === 0) {
                $this->log->info("Skipping, no emails found", ['pipe' => $pipe->username]);
                continue;
            }

            $this->log->info("Processing {$mail_count} emails", ['pipe' => $pipe->username]);
            foreach($mails as $mail_id) {
                $msg = $mailbox->getMail($mail_id);
                $this->fromMailMessage($pipe, $msg);
                //$mailbox->deleteMail($mail_id);
            }
        }
    }

    /**
     * Convert an email message into a ticket
     *
     * @param App\Pipe $pipe
     * @param PhpImap\IncomingMail $message
     * @return void
     */
    public function fromMailMessage(Pipe $pipe, IncomingMail $message)
    {
        // Check that user exists
        $user = User::where('email', $message->fromAddress)->get()->first();
        if (empty($user)) {
            // No user found, discard this email
            return;
        }

        // Is this a reply to an existing ticket?
        $ticket = $this->createOrFindTicket($pipe, $user, $message);

        // Add response to ticket
        $response = $this->createResponseToTicket($ticket, $message);

        // Handle Attachments
        // TODO


        if ($ticket->fresh()->reply_count === 1) {
            event(new TicketCreated($ticket));
            return;
        }

        event(new TicketReplyCreated($response));
    }

    /**
     * Create a response to the ticket with the given email body
     *
     * @param App\Ticket $ticket
     * @param PhpImap\IncomingMail $message
     * @return Response
     */
    public function createResponseToTicket(Ticket $ticket, IncomingMail $message): Response
    {
        $ticket->reply_count += 1;
        $ticket->save();

        return $ticket->responses()->create([
            'author_id'   => $ticket->user->id,
            'author_type' => 'App\User',
            'from'        => $message->fromAddress,
            'content'     => $message->textPlain
        ]);
    }

    /**
     * Find the ticket that this message belongs to, or create a new
     * one if needed
     *
     * @param App\Pipe $pipe
     * @param App\User $user
     * @param PhpImap\IncomingMail $message
     * @return App\Ticket
     */
    public function createOrFindTicket(Pipe $pipe, User $user, IncomingMail $message): Ticket
    {
        $ticket = null;
        $ticket_id = $this->parseTicketIdFromSubject($message->subject);
        if (!empty($ticket_id)) {
            // Get existing ticket to add response to
            $ticket = Ticket::find($ticket_id);
        }

        if (empty($ticket)) {
            // No existing ticket found, create a new one
            $ticket = Ticket::create([
                'user_id'       => $user->id,
                'department_id' => $pipe->department_id,
                'subject'       => $message->subject,
                'reply_count'   => 0,
                'last_replier'  => $user->name
            ]);
        }

        return $ticket;
    }

    /**
     * Attempt to find a ticket ID in the subject of the message
     *
     * @param string $subject
     * @return int|null
     */
    public function parseTicketIdFromSubject(string $subject)
    {
        preg_match("[Ticket (?<ticketid>[0-9]+)]", $subject, $matches);
        if (!empty($matches[1])) {
            return intval($matches[1]);
        }
    }
}
