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
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');

            $table->unsignedInteger('categories_id');
            $table->unsignedInteger('reported_by');
            $table->unsignedInteger('assigned_by');
            $table->unsignedInteger('assigned_to');

            $table->string('due_date'); //->nullable();
            $table->string('priority'); //->nullable();
            $table->mediumText('status');

            $table->timestamps();

            $table->foreign('categories_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('assigned_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('assigned_to')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('reported_by')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('tickets');
    }
};
