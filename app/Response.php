<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{

    protected $fillable = ['content', 'from', 'user_id'];

    protected static function boot()
    {
        parent::boot();
        static::created(function($response) {
            $response->ticket->increment('reply_count');
        });
        static::deleted(function($response) {
            $response->ticket->decrement('reply_count');
        });
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
