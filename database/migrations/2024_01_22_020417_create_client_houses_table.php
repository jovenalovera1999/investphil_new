<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_houses', function (Blueprint $table) {
            $table->bigIncrements('client_house_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('house_id');
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('house_id')
                ->references('house_id')
                ->on('houses')
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
        Schema::dropIfExists('client_houses');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
