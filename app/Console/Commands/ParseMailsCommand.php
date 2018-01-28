<?php

namespace App\Console\Commands;

use App\Pipe;
use Monolog\Logger;
use PhpImap\Mailbox;
use Illuminate\Console\Command;
use Monolog\Handler\StreamHandler;

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
                Pipe::fromMailMessage($msg);
                //$mailbox->deleteMail($mail_id);
            } 
        }
    }
    
}
