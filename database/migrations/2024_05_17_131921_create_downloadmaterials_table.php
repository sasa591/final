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
        Schema::create('downloadmaterials', function (Blueprint $table) {
            $table->id();
            $table->integer('usr_id');
            $table->string('chapter');
            $table->string('image_hweya');
            $table->string('first_material');
            $table->string('second_material')->default('');
            $table->string('year_of_the_artical');
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
        Schema::dropIfExists('downloadmaterials');
    }
};
