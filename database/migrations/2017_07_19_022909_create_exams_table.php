<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('synonymous');
            $table->string('method');
            $table->integer('material_id')->unsigned();
            $table->string('fasting');
            $table->string('routine');
            $table->text('use');
            $table->integer('category_id')->unsigned();
            $table->char('active');
            $table->foreign('material_id')
                ->references('id')
                ->on('materials');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
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
        Schema::dropIfExists('exams');
    }
}
