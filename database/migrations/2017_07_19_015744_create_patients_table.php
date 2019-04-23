<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->char('sex');
            $table->string('cpf');
            $table->string('rg');
            $table->date('dt_birth');
            $table->string('email',100);
            $table->string('street',150);
            $table->integer('city_id')->unsigned();
            $table->char('active');
            $table->foreign('city_id')
                ->references('id')
                ->on('cities');
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
        Schema::dropIfExists('patients');
    }
}
