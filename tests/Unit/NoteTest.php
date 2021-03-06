<?php

namespace Tests\Unit;

use App\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NoteTest extends TestCase
{

    protected $note;

    public function setUp()
    {
        parent::setUp();
        $this->note = new Note();
    }

    /** @test */
    public function note_belongs_to_a_product()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->note->product());
    }

    /** @test */
    public function note_belongs_to_an_admin()
    {
        $this->assertInstanceOf(BelongsTo::class, $this->note->author());
    }
}
