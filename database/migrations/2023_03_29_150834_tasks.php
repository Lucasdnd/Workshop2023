<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->text('description');
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contacts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};

