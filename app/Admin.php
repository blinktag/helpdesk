<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function confirmationToken()
    {
        return $this->hasOne(ConfirmationToken::class);
    }

    /**
     * Create a new account confirmation token for this user
     */
    public function generateConfirmationToken(): string
    {
        $token = str_random(50);

        $this->confirmationToken()->create([
            'token'      => $token,
            'expires_at' => $this->freshTimestamp()->addMinutes(10)
        ]);

        return $token;
    }

    /**
     * Generate gravatar URL for the user
     *
     * @return string
     */
    public function getGravatarUrl(): string
    {
        $hash = md5(strtolower($this->email));
        return "https://www.gravatar.com/avatar/{$hash}";
    }
}
