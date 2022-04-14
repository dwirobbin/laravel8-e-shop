<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->unsignedInteger('original_price');
            $table->unsignedInteger('selling_price');
            $table->unsignedInteger('quantity');
            $table->integer('tax');
            $table->string('image')->nullable();
            $table->text('description');
            $table->tinyInteger('seen_in_all_product')->default('0');
            $table->tinyInteger('seen_in_trending_products')->default('0');
            $table->foreignId('category_id')->constrained();
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
        Schema::dropIfExists('products');
    }
}
