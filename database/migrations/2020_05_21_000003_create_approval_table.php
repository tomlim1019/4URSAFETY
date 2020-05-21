<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval', function (Blueprint $table) {
            //$table->integer('staff_id');
            //$table->integer('customer_id');
            $table->foreignId('staff_id')->constrained('staff');
            $table->foreignId('customer_id')->constrained('customer');
            $table->string('status', 10)->default('pending');
            $table->timestamps();
            $table->primary(['staff_id', 'customer_id']);
        });

        DB::statement('ALTER TABLE approval ADD CONSTRAINT check_status CHECK (status="approved" OR status="pending" OR status="rejected");');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approval');
    }
}
