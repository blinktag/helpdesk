<?php

namespace Tests\Unit;

use App\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseTest extends TestCase
{
    protected $response;

    public function setUp()
    {
        parent::setUp();
        $this->response = new Response();
    }

    /** @test */
    public function response_author_is_polymorph()
    {
        $this->assertInstanceOf(MorphTo::class, $this->response->author());
    }

    /** @test */
    public function response_belongs_to_ticket()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->response->ticket());
    }
}
