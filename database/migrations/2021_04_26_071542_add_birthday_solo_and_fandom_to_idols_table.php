<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBirthdaySoloAndFandomToIdolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('idols', function (Blueprint $table) {
            $table->boolean('solo');
            $table->string('fanclub_name')->nullable();
            $table->date('birthday')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('idols', function (Blueprint $table) {
            $table->dropColumn(array('solo', 'fanclub_name', 'birthday'));
        });
    }
}
