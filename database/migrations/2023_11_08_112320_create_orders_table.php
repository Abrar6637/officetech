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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('order_status');
            $table->string('payment_status');
            $table->integer('discount_amount')->nullable();
            $table->integer('total_amount')->nullable();
            $table->integer('shipping_amount')->nullable();
            $table->integer('grand_total')->nullable();
            $table->string('discount_code_coppen')->nullable();
            $table->enum('arabic_switch', ['0', '1'])->default('0')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
