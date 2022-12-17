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
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('name');
            $table->mediumText('location');
            $table->mediumText('email');
            $table->timestamps();

            $table->unsignedInteger('users_id');
            $table->unsignedInteger('departments_id');

            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('departments_id')
                ->references('id')
                ->on('departments')
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
        Schema::dropIfExists('profiles');
    }
};
