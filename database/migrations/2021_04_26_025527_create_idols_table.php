<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idols', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('group_id')->nullable();
            $table->integer('company_id');
            $table->string('gender', 1);
            $table->integer('user_id')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idols');
    }
}
