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
        Schema::table('navigations', function (Blueprint $table) {
            $table->foreignId('news_id')->nullable()->constrained('news')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->dropForeign(['news_id']);
            $table->dropColumn('news_id');
        });
    }
};
