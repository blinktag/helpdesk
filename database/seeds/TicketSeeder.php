<?php

use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tickets = factory(App\Ticket::class, 3)->create();

        $tickets->each(function($t) {
            factory(App\Response::class, 3)->create([
                'user_id'   => $t->user_id,
                'ticket_id' => $t->id
            ]);
        });
    }
}
