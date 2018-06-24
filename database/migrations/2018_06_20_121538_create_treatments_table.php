<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('description');
            $table->integer('price');
            $table->timestamps();
        });

        Schema::create('appointment_treatment', function (Blueprint $table) {
            $table->unsignedInteger('treatment_id');
            $table->unsignedInteger('appointment_id');
            $table->foreign('treatment_id')->references('id')->on('treatments')->onDelete('cascade');
        $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->primary(['treatment_id', 'appointment_id']);
            $table->string('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_treatment');
        Schema::dropIfExists('treatments');
    }
}
