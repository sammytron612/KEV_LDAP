<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnboardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onboardings', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('telephone');
            $table->string('email');
            $table->string('start_date');
            $table->string('site');
            $table->string('division');
            $table->string('setup_location')->nullable();
            $table->string('job_title');
            $table->string('ethernet_cable')->nullable();
            $table->string('internet_provider')->nullable();
            $table->integer('campaign_id');
            $table->integer('assigned_to');
            $table->string('equipment_collection')->nullable();
            $table->string('notes')->nullable();
            $table->integer('batch_no');
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
        Schema::dropIfExists('onboardings');
    }
}
