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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertiser_id')->index();
            $table->string('title');
            $table->string('url');
            $table->decimal('reward_amount', 10, 4);
            $table->integer('duration_seconds');
            $table->integer('total_clicks');
            $table->integer('remaining_clicks')->index();
            $table->enum('status', ['pending', 'active', 'paused', 'completed', 'rejected'])->default('pending')->index();
            $table->json('country_targets')->nullable();
            $table->json('device_targets')->nullable();
            $table->timestamps();

            $table->foreign('advertiser_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
