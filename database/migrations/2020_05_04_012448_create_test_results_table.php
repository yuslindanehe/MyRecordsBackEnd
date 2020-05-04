<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patientId');
            $table->date('testDate');
            $table->string('testName');
            $table->text('testResult');
            $table->unsignedBigInteger('orderedBy');
            $table->timestamps();

            $table->foreign('patientId')->references('id')->on('patient');
            $table->foreign('orderedBy')->references('id')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_results', function (Blueprint $table) {
            Schema::dropIfExists('test_results');
        });
    }
}
