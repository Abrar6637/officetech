<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('account_managers', function (Blueprint $table) {
            $table->string("is_default_manager")->nullable();
        });
    }
    public function down()
    {
        Schema::table('account_managers', function (Blueprint $table) {
            $table->dropColumn("is_default_manager");
        });
    }
};
