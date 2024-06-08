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
        Schema::table('request_services', function (Blueprint $table) {
            $table->renameColumn('serial_number', 'serial_num_call_req');
            $table->string('serial_num_contract_req');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_services', function (Blueprint $table) {
            $table->renameColumn('serial_num_call_req', 'serial_number');
            $table->dropColumn('serial_num_contract_req');
        });
    }
};
