<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLoanApplicationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_application_details', function (Blueprint $table) {
            $table->longText('spouse_comaker_info')->nullable()->after('loan_id');
            $table->longText('farming_info')->nullable()->after('spouse_comaker_info');
            $table->longText('employment_info')->nullable()->after('farming_info');
            $table->longText('income_asset_info')->nullable()->after('employment_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_application_details', function (Blueprint $table) {
            $table->dropColumn('spouse_comaker_info');
            $table->dropColumn('farming_info');
            $table->dropColumn('employment_info');
            $table->dropColumn('income_asset_info');
        });
    }
}
