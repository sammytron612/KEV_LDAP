<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_trainings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('module_id');
            $table->json('lessons_complete')->nullable();
            $table->integer('completed')->default(0);
            $table->string('date_completed')->nullable();
            $table->integer('assessment')->nullable();
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
        Schema::dropIfExists('assigned_trainings');
    }
}
