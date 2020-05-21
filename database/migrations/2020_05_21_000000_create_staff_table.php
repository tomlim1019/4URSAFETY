<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('username', 20);
            $table->string('email', 50);
            $table->string('password', 30);
            $table->string('name', 30);
            $table->string('user_type', 10);
            $table->timestamps();
            $table->unique('username');
            $table->unique('email');
        });

        DB::statement('ALTER TABLE staff ADD CONSTRAINT check_user_type CHECK (user_type="admin" OR user_type="staff");');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
