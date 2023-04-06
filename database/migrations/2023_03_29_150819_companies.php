<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });

        $faker = \Faker\Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            DB::table('companies')->insert([
                'name' => $faker->company,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'state' => $faker->state,
                'zip_code' => $faker->postcode,
                'country' => $faker->country,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $faker = \Faker\Factory::create();
        $companies = DB::table('companies')->pluck('id')->toArray();
        $b2bCount = 0;
        for ($i = 0; $i < 20; $i++) {
            if ($i % 3 == 0) {
                $b2bCount++;
                DB::table('contacts')->insert([
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->lastName(),
                    'email' => $faker->email(),
                    'phone' => $faker->phoneNumber(),
                    'address' => $faker->streetAddress(),
                    'city' => $faker->city(),
                    'state' => $faker->state(),
                    'zip_code' => $faker->postcode(),
                    'country' => $faker->country(),
                    'company_id' => $companies[array_rand($companies)],
                    'status' => $faker->randomElement(['lead', 'prospect', 'client', 'dead_lead', 'dead_prospect']),
                    'type' => 'B2B',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('contacts')->insert([
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->lastName(),
                    'email' => $faker->email(),
                    'phone' => $faker->phoneNumber(),
                    'address' => $faker->streetAddress(),
                    'city' => $faker->city(),
                    'state' => $faker->state(),
                    'zip_code' => $faker->postcode(),
                    'country' => $faker->country(),
                    'status' => $faker->randomElement(['lead', 'prospect', 'client', 'dead_lead', 'dead_prospect']),
                    'type' => 'B2C',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        echo "$b2bCount contacts are linked to companies.\n";
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
