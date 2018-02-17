<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pipe extends Model
{

    protected $guarded = ['id'];

    /**
     * Generate DNS for connecting to mailbox
     *
     * @return string
     */
    public function getMailDSN(): string
    {
        return sprintf('{%s:143/imap/novalidate-cert}INBOX', $this->server);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
