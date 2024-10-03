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
            $table->increments('id');
            $table->string('code', 10);
            $table->string('name', 50);
            $table->integer('category_id')->unsigned(); // unsigned for reference to primary key which is all number is greater than 0
            $table->integer('branch_id')->unsigned(); // unsigned for reference to primary key which is all number is greater than 0
            $table->float('price')->nullable();
            $table->integer('stock_qty')->nullable();
            $table->string('image_url', 200)->nullable();
            $table->timestamps();
            // foreign key
            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('branch_id')->references('id')->on('branch');
        });
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
