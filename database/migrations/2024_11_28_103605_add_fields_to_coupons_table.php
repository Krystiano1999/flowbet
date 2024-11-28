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
        Schema::table('coupons', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained()->cascadeOnDelete(); 
            $table->unsignedInteger('events_count')->after('loss_amount')->default(0); 
            $table->unsignedInteger('won_events_count')->after('events_count')->default(0); 
            $table->unsignedInteger('lost_events_count')->after('won_events_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'events_count', 'won_events_count', 'lost_events_count']);
        });
    }
};
