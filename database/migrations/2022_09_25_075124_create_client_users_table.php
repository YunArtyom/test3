<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up()
    {
        Schema::create('client_users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->integer('balance');
            $table->integer('mobile_number')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('client_users');
    }
};
