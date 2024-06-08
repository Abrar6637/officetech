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
        Schema::create('request_services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_id');
            $table->string('contract_year_duration')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('service_call_type')->nullable();
            $table->string('service_call_description')->nullable();
            $table->bigInteger('order_id')->nullable();
            $table->enum('status', ['0', '1'])->default(0)->nullable();
            $table->bigInteger('user_id')->nullable();
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
        Schema::dropIfExists('request_services');
    }
};
