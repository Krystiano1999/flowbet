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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('step_id')->constrained()->cascadeOnDelete(); 
            $table->enum('type', ['standard', 'extra']); 
            $table->decimal('amount', 10, 2); 
            $table->decimal('odds', 10, 2); 
            $table->enum('result', ['win', 'lose', 'null'])->default('null'); 
            $table->decimal('win_amount', 10, 2)->nullable(); 
            $table->decimal('loss_amount', 10, 2)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
