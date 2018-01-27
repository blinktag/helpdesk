<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\ConfirmationToken;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User extends TestCase
{

    use DatabaseMigrations;

    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(\App\User::class)->create();
    }

    /** @test */
    public function user_has_tickets()
    {
        $this->assertInstanceOf(Collection::class, $this->user->tickets);
    }

    /** @test */
    public function user_has_confirmation_token()
    {
        $this->assertInstanceOf(HasOne::class, $this->user->confirmationToken());
    }

    /** @test */
    public function can_generate_confirmation_token()
    {
        $this->user->generateConfirmationToken();
        $token = $this->user->confirmationToken;
        $this->assertInstanceOf(ConfirmationToken::class, $token);
    }

    /** @test */
    public function getGravatarUrl()
    {
        $this->user->email = 'admin@helpdesk.test';

        $expected = 'https://www.gravatar.com/avatar/9a01986d3f5984c54e5c48587decfcb9';
        $this->assertSame($expected, $this->user->getGravatarUrl());
    }

}
