<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function confirmationToken()
    {
        return $this->hasOne(ConfirmationToken::class);
    }

    /**
     * Create a new account confirmation token for this user
     */
    public function generateConfirmationToken()
    {
        $token = str_random(50);

        $this->confirmationToken()->create([
            'token'      => $token,
            'expires_at' => $this->freshTimestamp()->addMinutes(10)
        ]);

        return $token;
    }


}
