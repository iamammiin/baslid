<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('instagram_username')->unique()->nullable();
            $table->string('youtube_username')->unique()->nullable();
            $table->string('tiktok_username')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('instagram_username');
            $table->dropColumn('youtube_username');
            $table->dropColumn('tiktok_username');
        });
    }
};
