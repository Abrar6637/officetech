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
        Schema::table('sub_main_categories', function (Blueprint $table) {
            $table->string('slug')->after('parent_category_id')->nullable();
            $table->integer('status')->after('slug')->nullable();
            $table->integer('category_order')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_main_categories', function (Blueprint $table) {
            $table->dropColumn(['slug','status', 'category_order']);
        });
    }
};
