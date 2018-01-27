<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfirmationToken extends Model
{
    public $timestamps = false;

    protected $dates = ['expires_at'];

    protected $fillable = ['token', 'expires_at'];

    public static function boot()
    {
        static::creating(function($token) {
            optional($token->user->confirmationToken())->delete();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'token';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Determine if token is expired
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->freshTimestamp()->gt($this->expires_at);
    }
}
