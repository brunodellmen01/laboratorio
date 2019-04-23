<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->integer('clinic_id')->unsigned();
            $table->integer('laboratory_id')->unsigned();
            $table->integer('medic_id')->unsigned();
            $table->integer('patient_id')->unsigned();
            $table->foreign('clinic_id')
                ->references('id')
                ->on('clinics');
            $table->foreign('laboratory_id')
                ->references('id')
                ->on('laboratories');
            $table->foreign('medic_id')
                ->references('id')
                ->on('medics');
            $table->foreign('patient_id')
                ->references('id')
                ->on('patients');
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
        Schema::dropIfExists('phones');
    }
}
