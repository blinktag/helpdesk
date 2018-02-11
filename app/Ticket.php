<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    //use Searchable;

    protected $guarded = ['id'];

    protected $dates = ['last_reply'];

    protected $casts = [
        'reply_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'product');
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
