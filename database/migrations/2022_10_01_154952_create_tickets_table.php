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
            $table->unsignedInteger('assigned_by')->nullable();
            $table->unsignedInteger('assigned_to')->nullable();

            $table->string('due_date')->nullable();
            $table->string('priority'); //->nullable();
            $table->mediumText('status');

            //This will be used to indicate whether the reported
            // has marked as resolved.
            $table->boolean('resolved')->default(false);

            // Comments can be added by the admin to the IT staff
            // being assigned to
            $table->mediumText('comment')->nullable();

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
