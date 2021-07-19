<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanApplicationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_application_details', function (Blueprint $table) {
            $table->id();
            $table->integer('model_id')->nullable();
            $table->string('model_type')->nullable();
            $table->text('loan_detail')->nullable();
            $table->text('credit_financial_information')->nullable();
            $table->text('references')->nullable();
            $table->string('')->nullable();

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
        Schema::dropIfExists('loan_application_details');
    }
}
