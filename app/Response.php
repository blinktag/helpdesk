<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
