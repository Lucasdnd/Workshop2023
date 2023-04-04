<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactActionCommentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contact_action_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('action_id');
            $table->unsignedBigInteger('user_id')->nullable(); // Add this line
            $table->text('comment');
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('action_id')->references('id')->on('actions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Add this line
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('contact_action_comments');
    }
}
