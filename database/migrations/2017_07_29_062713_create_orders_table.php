<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->unsigned();
            $table->integer('patient_id')->unsigned();
            $table->date('date');
            $table->integer('medic_id')->unsigned();
            $table->string('type');
            $table->integer('user_id')->unsigned();
            $table->decimal('value');
            $table->integer('clinic_id')->unsigned();
            $table->string('protocol');
            $table->integer('covenant_id')->unsigned();
            $table->decimal('value_entry');
            $table->string('delivery');
            $table->date('dt_retire');
            $table->timestamps();
        });

            Schema::create('exam_order', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('exam_id')->unsigned();
                $table->integer('order_id')->unsigned();
                $table->foreign('exam_id')
                    ->references('id')
                    ->on('exams');
                $table->foreign('order_id')
                    ->references('id')
                    ->on('orders');
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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('exam_order');
    }
}
