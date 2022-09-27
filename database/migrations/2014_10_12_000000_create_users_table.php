<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('username')->nullable();
            $table->string('upn')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_image')->nullable(); // add this line
            $table->bigInteger('workplace_id')->nullable();
            $table->bigInteger('manager')->nullable();
            $table->string('department')->nullable();
            $table->string('site')->nullable();
            $table->string('title')->nullable();
            $table->rememberToken();
	        $table->string('guid')->unique()->nullable();
            $table->string('domain')->nullable();
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
        Schema::dropIfExists('users');
    }
}
