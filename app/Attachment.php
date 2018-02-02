<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'name', 'size', 'location', 'mime_type'
    ];

    public function response()
    {
        return $this->belongsTo(Response::class);
    }

    /**
     * Display file size in kilobytes
     *
     * @return string
     */
    public function getSizeInKilobytes(): string
    {
        return number_format($this->size / 1024, 2);
    }
}
