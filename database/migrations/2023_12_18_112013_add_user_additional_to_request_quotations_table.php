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
            $table->string("grand_total")->nullable();
            $table->string("vat_amount")->nullable();
            $table->string("total_amount")->nullable();
            $table->string("discount_code_coppen")->nullable();
            $table->string("account_manager")->nullable();
            $table->string("region_state")->nullable();
        });
    }

    public function down()
    {
        Schema::table('request_quotations', function (Blueprint $table) {
            $table->dropColumn("grand_total");
            $table->dropColumn("vat_amount");
            $table->dropColumn("total_amount");
            $table->dropColumn("discount_code_coppen");
            $table->dropColumn("account_manager");
            $table->dropColumn("region_state");
        });
    }
};
