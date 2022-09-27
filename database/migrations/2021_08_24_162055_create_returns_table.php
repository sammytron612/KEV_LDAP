<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('campaign');
            $table->string('date_time');
            $table->text('notes')->nullable();
            $table->integer('actioned')->default(0);
            $table->integer('returned')->default(0);
            $table->string('it_notes')->nullable();
            $table->string('date_returned')->nullable();
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
        Schema::dropIfExists('returns');
    }
}
