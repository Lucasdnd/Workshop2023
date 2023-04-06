<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('comment');
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('action_id')->references('id')->on('actions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        $actions = DB::table('actions')->get();
        $user = DB::table('users')->where('email', 'admin@admin.com')->first();

        $faker = \Faker\Factory::create();
        foreach ($actions as $action) {
            $commentCount = rand(1, 3);
            for ($i = 0; $i < $commentCount; $i++) {
                DB::table('contact_action_comments')->insert([
                    'contact_id' => $action->contact_id,
                    'action_id' => $action->id,
                    'user_id' => $user->id,
                    'comment' => $faker->paragraph(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('contact_action_comments');
    }
}
