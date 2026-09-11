<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tahukah_anda', function (Blueprint $table) {
            $table->string('image')->nullable()->after('thumbnail');
            $table->string('subtitle')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('tahukah_anda', function (Blueprint $table) {
            $table->dropColumn(['image', 'subtitle']);
        });
    }
};