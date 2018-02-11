<?php

use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Response::class, 3)->create([
            'user_id' => 1,
            'ticket_id' => function() {
                factory(App\Ticket::class, 3)->create([
                    'department_id' => function() {

                    },
                    'author_id' => 1,
                    'author_type' => 'App\User'
                ]);
            }
        ]);
    }
}
