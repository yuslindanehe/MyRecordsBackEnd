<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patientId');
            $table->unsignedBigInteger('doctorId');
            $table->unsignedBigInteger('nurseId');
            $table->date('visitDate');
            $table->double('weight');
            $table->string('bloodPressure');
            $table->text('diagnose');
            $table->unsignedBigInteger('prescriptionId')->nullable();
            $table->timestamps();

            $table->foreign('patientId')->references('id')->on('patient');
            $table->foreign('doctorId')->references('id')->on('staff');
            $table->foreign('nurseId')->references('id')->on('staff');
            $table->foreign('prescriptionId')->references('id')->on('prescription');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visit');
    }
}
