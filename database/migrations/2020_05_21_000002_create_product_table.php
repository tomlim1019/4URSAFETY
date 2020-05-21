<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->text('description');
            $table->string('category', 50);
            $table->text('image')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('tenure');
            $table->timestamps();
            $table->unique(['name', 'category']);
        });

        DB::statement('ALTER TABLE product ADD CONSTRAINT check_price CHECK (price >= 0);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
