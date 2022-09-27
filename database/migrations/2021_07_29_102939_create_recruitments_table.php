<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->string('intake_date')->nullable();
            $table->integer('heads')->nullable();
            $table->integer('webcams')->nullable();
            $table->integer('headsets')->nullable();
            $table->string('date_pc_required')->nullable();
            $table->string('work_location')->nullable();
            $table->string('training_location')->nullable();
            $table->string('trainer')->nullable();
            $table->json('notes')->nullable();
            $table->integer('completed')->default(0);
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
        Schema::dropIfExists('recruitments');
    }
}
