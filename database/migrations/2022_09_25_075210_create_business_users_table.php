<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up()
    {
        Schema::create('business_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('balance');
            $table->string('bank_account', 12)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('business_users');
    }
};
