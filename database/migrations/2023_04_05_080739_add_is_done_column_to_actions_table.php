<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDoneColumnToActionsTable extends Migration
{
    public function up()
    {
        Schema::table('actions', function (Blueprint $table) {
            $table->boolean('is_done')->default(false);
        });
    }

    public function down()
    {
        Schema::table('actions', function (Blueprint $table) {
            $table->dropColumn('is_done');
        });
    }
}
