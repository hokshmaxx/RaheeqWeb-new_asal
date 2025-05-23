<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GiftPackagings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('gift_packagings', function (Blueprint $table) {
//            $table->id();
//            $table->string('title_ar');
//            $table->string('title_en');
//            $table->decimal('price', 10, 2)->default(0);
//            $table->string('image')->nullable();
//            $table->timestamps();
//        });
//
//        Schema::create('product_gift_packaging', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('product_id');
//            $table->unsignedBigInteger('gift_packaging_id');
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
//            $table->foreign('gift_packaging_id')->references('id')->on('gift_packagings')->onDelete('cascade');
//            $table->timestamps();
//        });
//
//        Schema::table('products', function (Blueprint $table) {
//            $table->boolean('allow_gift_packaging')->default(false);
//        });
//        Schema::table('orders', function (Blueprint $table) {
//            $table->unsignedBigInteger('gift_packaging_id')->nullable();
//            $table->string('gift_note')->nullable();
//
//            $table->foreign('gift_packaging_id')->references('id')->on('gift_packagings')->onDelete('set null');
//        });

        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('gift_packaging_id')->nullable();
//            $table->string('gift_note')->nullable();

            $table->foreign('gift_packaging_id')->references('id')->on('gift_packagings')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
