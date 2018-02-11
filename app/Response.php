<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{

    //use Searchable;

    protected $fillable = ['content', 'from', 'author_id', 'author_type'];
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

    /**
     * Cutomize Scout search record
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
      $data = $this->toArray();

      $data['ticket_subject'] = $this->ticket->subject;
      $data['author'] = [
        'name'  => $this->user->name,
        'email' => $this->user->email,
      ];

      return $data;
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function author()
    {
        return $this->morphTo();
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
