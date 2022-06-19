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
        Schema::create('time_schedules', function (Blueprint $table) {
            $table->id();

            $table->string('time_from');
            $table->string('time_to');
            $table->boolean('available');
            $table->bigInteger('slots')->default(0);

            $table->foreignId('department_id');
            $table->foreign('department_id')->references('id')->on('departments');

            $table->string('am_pm')->default('am');

            $table->foreignId('week_schedule_id');
            $table->foreign('week_schedule_id')->references('id')->on('week_schedules');

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
        Schema::dropIfExists('time_schedules');
    }
};
