<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->tickets);
    }

    /** @test */
    public function getGravatarUrl()
    {
        $this->user->email = 'Admin@helpdesk.test';

        $expected = 'https://www.gravatar.com/avatar/9a01986d3f5984c54e5c48587decfcb9';
        $this->assertSame($expected, $this->user->getGravatarUrl());
    }

}
