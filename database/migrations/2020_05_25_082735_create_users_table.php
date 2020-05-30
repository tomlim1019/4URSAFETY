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
            $table->string('email')->unique();
            $table->string('id_no')->unique();
            $table->date('birthdate');
            $table->enum('gender', ['Male', 'Female', 'Others']);
            $table->enum('role', ['customer', 'staff', 'admin'])->default('admin');
            $table->enum('status', ['Approved', 'Pending'])->default('Pending');
            $table->string('document');
            $table->string('password');
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
