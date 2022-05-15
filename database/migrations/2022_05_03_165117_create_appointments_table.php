<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {

            $table->id();

            $table->string('student_name');

            $table->foreignId('document_id');
            $table->foreign('document_id')->references('id')->on('documents');

            $table->foreignId('department_id');
            $table->foreign('department_id')->references('id')->on('departments');

            $table->date('appointment_date');
            $table->string('time_from');
            $table->string('time_to');
            $table->string('appointment_code');

            $table->string('status')->default('pending');
            $table->string('notes')->nullable();

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('appointments');
    }
};
