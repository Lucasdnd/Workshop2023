<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;

return new class extends Migration
{
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->enum('type', ['call', 'email', 'meeting', 'note', 'other']);
            $table->text('comment')->nullable();
            $table->boolean('is_done')->default(false);
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamps();

            $table->foreign('contact_id')->references('id')->on('contacts');
        });

        $contacts = Contact::all();
        $actionTypes = ['call', 'email', 'meeting', 'note', 'other'];
        foreach ($contacts as $contact) {
            for ($i = 0; $i < 4; $i++) {
                DB::table('actions')->insert([
                    'contact_id' => $contact->id,
                    'type' => $actionTypes[rand(0, 4)],
                    'comment' => 'Lorem ipsum dolor sit amet.',
                    'scheduled_at' => now()->addDays(rand(1, 30)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('actions');
    }
};
