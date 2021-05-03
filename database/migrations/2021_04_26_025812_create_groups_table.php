<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->date('debut_date')->nullable();
            $table->integer('num_members')->nullable();
            $table->string('fanclub_name')->nullable();
            $table->boolean('active')->nullable();
            $table->integer('company_id');
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
        // Schema::dropColumns('groups', ['company_id']);
        Schema::dropIfExists('groups');
    }
}
