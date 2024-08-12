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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('code');
            $table->string('purview')->default("");
            $table->string('year')->default("");
            $table->string('email')->default("");
            $table->string('password')->default("");
            $table->string('gender')->default("");
            $table->string('adress')->default(" ");
            $table->integer('phone')->default("0");
            $table->date('birth')->default(now());
            $table->string('title')->default("");
            $table->integer('years_experience')->default("0");
            $table->string('about_me')->default("");

            $table->string('img')->default("");
            $table->timestamps();
            $table->integer('balance')->default("0");
            $table->string('type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
