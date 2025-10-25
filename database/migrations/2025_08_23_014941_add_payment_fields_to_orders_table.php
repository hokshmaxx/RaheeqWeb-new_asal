<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add payment status column if it doesn't exist
            if (!Schema::hasColumn('orders', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'pending_payment', 'completed', 'failed', 'cancelled'])
                    ->default('pending')
                    ->after('payment_method');
            }

            // Add Tap payment ID column
            if (!Schema::hasColumn('orders', 'tap_payment_id')) {
                $table->string('tap_payment_id')->nullable()->after('payment_status');
            }

            // Add payment details JSON column for storing additional payment info
            if (!Schema::hasColumn('orders', 'payment_details')) {
                $table->json('payment_details')->nullable()->after('tap_payment_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
