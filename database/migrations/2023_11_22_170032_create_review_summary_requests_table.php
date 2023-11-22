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
        Schema::create('review_summary_requests', function (Blueprint $table) {
            $table->id();
            $table->string('room_id');
            $table->integer('current_sprint_day');
            $table->integer('current_sprint_current_morale');
            $table->integer('current_sprint_progress');
            $table->integer('current_sprint_done');
            $table->integer('current_sprint_open');
            $table->json('current_sprint_blocked')->nullable();

            $table->integer('last_sprint_day');
            $table->integer('last_sprint_current_morale')->nullable();
            $table->integer('last_sprint_progress')->nullable();
            $table->integer('last_sprint_done')->nullable();
            $table->integer('last_sprint_open')->nullable();
            $table->json('last_sprint_blocked')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_summary_requests');
    }
};
