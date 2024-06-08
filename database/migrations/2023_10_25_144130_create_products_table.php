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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->integer('categories_id')->nullable();
            $table->integer('sub_categories_id')->nullable();
            $table->integer('sub_sub_categories_id')->nullable();
            $table->integer('product_type_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('sku');
            $table->string('name');
            $table->string('model_number');
            $table->string('availability');
            $table->integer('quantity');
            $table->string('price');
            $table->string('sale_price')->nullable();
            $table->text('specifications')->nullable();
            $table->string('license')->nullable();
            $table->text('product_description')->nullable();
            $table->string('warrenty')->nullable();
            $table->enum('status', ['0', '1'])->default('0');
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
        Schema::dropIfExists('product');
    }
};
