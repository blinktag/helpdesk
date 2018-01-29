<?php

namespace Tests\Unit;

use App\Pipe;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PipeTest extends TestCase
{
    /** @test */
    public function getMailDSN()
    {
        $pipe = new Pipe();
        $pipe->server = 'mail.google.com';

        $this->assertSame('{mail.google.com:143/imap/novalidate-cert}INBOX', $pipe->getMailDSN());
    }
}
