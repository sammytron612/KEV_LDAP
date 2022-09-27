<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffboardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offboardings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('domain');
            $table->string('leave_date');
            $table->integer('submitted_by');
            $table->integer('actioned')->default(0);
            $table->string('completed')->nullable();
            $table->integer('it')->nullable();
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
        Schema::dropIfExists('offboardings');
    }
}
