<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('department_id')->index();
            $table->string('subject');
            $table->unsignedInteger('user_id')->index();
            $table->enum('status', ['open','hold','closed']);
            $table->unsignedInteger('reply_count')->default(0);
            $table->dateTimeTz('last_reply')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('last_replier');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
