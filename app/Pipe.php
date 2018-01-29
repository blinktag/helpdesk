<?php

namespace App;

use PhpImap\IncomingMail;
use Illuminate\Database\Eloquent\Model;

class Pipe extends Model
{
    /**
     * Generate DNS for connecting to mailbox
     * 
     * @return string
     */
    public function getMailDSN(): string
    {
        return sprintf('{%s:143/imap/novalidate-cert}INBOX', $this->server);
    }

    public static function fromMailMessage(IncomingMail $message)
    {
        //
    }
}
