<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('IC', 30);
            $table->string('username', 20);
            $table->text('document');
            $table->string('email', 50);
            $table->string('password', 30);
            $table->string('name', 30);
            $table->integer('age');
            $table->string('address');
            $table->text('image')->nullable();
            $table->timestamps();
            $table->unique('IC');
            $table->unique('username');
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
