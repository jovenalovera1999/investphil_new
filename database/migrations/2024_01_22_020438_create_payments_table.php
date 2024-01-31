<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('payment_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->string('invoices', 55);
            $table->unsignedBigInteger('client_house_id');
            $table->unsignedBigInteger('downpayment_id');
            $table->double('monthly_paid')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();

            $table->foreign('payment_method_id')
                ->references('payment_method_id')
                ->on('payment_methods')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
            $table->foreign('client_house_id')
                ->references('client_house_id')
                ->on('client_houses')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('downpayment_id')
                ->references('downpayment_id')
                ->on('downpayments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('payments');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
