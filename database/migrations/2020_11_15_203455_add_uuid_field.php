<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUuidField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('notes', function (Blueprint $table) {
            $table->uuid('uuid');
        });

        Schema::table('tribes', function (Blueprint $table) {
            $table->uuid('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });

        Schema::table('tribes', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
}
