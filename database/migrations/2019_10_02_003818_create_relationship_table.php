<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationship', function (Blueprint $table) {
            $table->bigIncrements('id_relationship');
            $table->bigInteger('id');
            //$table->foreign('id')->references('id')->on('users');
            $table->string('id_kindOfRelationship');
            $table->integer('id_address')->nullable();
            $table->string('name');
            $table->string('phoneNumber');
            $table->date('time_met');
            $table->string('note');
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
        Schema::dropIfExists('relationship');
    }
}
