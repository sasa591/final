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
        Schema::create('permenancydocuments', function (Blueprint $table) {
            $table->id();
            $table->integer('usr_id');
            $table->string('chapter');
            $table->string('image_hweya');
            $table->string('year');
            $table->string('status')->default('pending');
            $table->integer('price')->default(2000);
            $table->string('replay')->default('');
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
        Schema::dropIfExists('permenancydocuments');
    }
};
