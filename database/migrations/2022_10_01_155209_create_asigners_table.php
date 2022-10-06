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
        Schema::create('asigners', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('name');
            $table->unsignedInteger('tickets_id');
            $table->timestamps();
            
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
        Schema::dropIfExists('asigners');
    }
};
