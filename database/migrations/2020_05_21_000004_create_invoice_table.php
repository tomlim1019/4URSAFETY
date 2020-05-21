<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id('invoice_num');
            $table->foreignId('customer_id')->constrained('customer');
            $table->foreignId('product_id')->constrained('product');
            $table->string('policy_number', 50);
            $table->string('status', 10)->default('pending');
            $table->timestamps();
            $table->unique(['customer_id', 'product_id']);
            $table->unique('policy_number');
        });
        
        DB::statement('ALTER TABLE invoice ADD CONSTRAINT check_status CHECK (status="waiting for payment" OR status="pending" OR status="rejected" OR status="done");');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
