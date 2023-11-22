<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('review_summary_requests', function (Blueprint $table) {
            $table->text('response_text')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('review_summary_requests', function (Blueprint $table) {
            $table->dropColumn('response_text');
        });
    }
};
