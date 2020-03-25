<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medication', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('qty');
            $table->boolean('refillable');
            $table->string('instruction');
            $table->unsignedBigInteger('prescriptionId');
            $table->timestamps();

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
        Schema::dropIfExists('medication');
    }
}
