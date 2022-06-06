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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('phone')->unique();
            $table->json('phone_contact')->nullable();
            $table->enum('role',['admin','teacher','student','superadmin'])->default('student');
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('gender',['male','female'])->nullable();
            $table->date('birthday')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Exam fields
            $table->string('midexam')->nullable();
            $table->string('finalexam')->nullable();

            $table->rememberToken();
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
};
