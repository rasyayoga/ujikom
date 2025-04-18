<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->dateTime('sale_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('total_price');
            $table->bigInteger('total_pay');
            $table->bigInteger('total_return')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('user_id');
            $table->bigInteger('point')->nullable();
            $table->bigInteger('total_point')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
