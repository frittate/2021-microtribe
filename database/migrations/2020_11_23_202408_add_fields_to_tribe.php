<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTribe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tribes', function (Blueprint $table) {
            //
            $table->integer('votes_for_approve')->nullable();
            $table->integer('votes_for_archive')->nullable();
            $table->integer('votes_for_delete')->nullable();
            $table->boolean('has_inbox')->nullable($value = true);
            $table->boolean('has_archive')->nullable($value = true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tribes', function (Blueprint $table) {
            //
            $table->dropColumn('votes_for_approve');
            $table->dropColumn('votes_for_archive');
            $table->dropColumn('votes_for_delete');
            $table->dropColumn('has_inbox');
            $table->dropColumn('has_archive');
        });
    }
}
