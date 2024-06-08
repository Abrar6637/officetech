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
        Schema::table('request_quotations', function (Blueprint $table) {
            //
            $table->string('added_by')->after('address');
            $table->integer('user_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_quotations', function (Blueprint $table) {
            //
            $table->dropColumn('added_by');
            $table->dropColumn('user_id');
        });
    }
};
