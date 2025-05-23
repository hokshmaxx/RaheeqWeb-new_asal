<?php

// use Illuminate\Database\Schema\;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends  Migration
{
    /**
     * Run the s.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('use_coupons', function (Blueprint $table) {
            $table->id();
            $table->id('coupons_id')->nullable();
            $table->string('code');
        });
    }

    /**
     * Reverse the s.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
