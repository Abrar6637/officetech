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
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('address');
            $table->string('country');
            $table->string('region_state')->nullable();
            $table->string('vat_reg_no')->nullable();
            $table->string('company_reg_no')->nullable();
            $table->string('account_manager')->nullable();
            $table->text('additional_notes')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->enum('arabic_switch', ['0', '1'])->default('0');
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
        Schema::dropIfExists('customer_orders');
    }
};
