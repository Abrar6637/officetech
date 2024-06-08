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
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->string('functional')->nullable();
            $table->string('speed')->nullable();
            $table->string('type')->nullable();
            $table->string('product_code')->nullable();
            $table->string('yeild')->nullable();
            $table->string('bundles')->nullable();
            $table->string('compatible_toners')->nullable();
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
        Schema::dropIfExists('product_attributes');
    }
};
