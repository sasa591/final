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
        Schema::create('objections', function (Blueprint $table) {
            $table->id();

            $table->integer('usr_id');
            $table->string('subject');
            $table->string('oretical_partical');
            $table->integer('mark');
            $table->string('reason_for_objection');
            $table->string('img');
            $table->string('status')->default('pending');
            $table->integer('price')->default(2000);
            $table->string('replay')->default('');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('objections');
    }


};
