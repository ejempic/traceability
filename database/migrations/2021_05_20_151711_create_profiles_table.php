<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->string('education')->nullable();
            $table->boolean('4ps')->default(0);
            $table->boolean('pwd')->default(0);
            $table->boolean('indigenous')->default(0);
            $table->boolean('livelihood')->default(0);
            $table->string('farmLot')->nullable();
            $table->string('farmingSince')->nullable();
            $table->string('memberOrganization')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
