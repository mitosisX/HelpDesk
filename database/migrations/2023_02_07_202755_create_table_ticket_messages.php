<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('tickets_id');
            $table->text('message');
            $table->timestamps();

            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('tickets_id')
                ->references('id')
                ->on('tickets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_ticket_messages');
    }
};
