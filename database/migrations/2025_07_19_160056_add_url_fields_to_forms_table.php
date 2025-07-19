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
        Schema::table('forms', function (Blueprint $table) {
            $table->string('custom_url')->nullable()->unique()->after('slug');
            $table->string('short_url', 10)->nullable()->unique()->after('custom_url');
            $table->boolean('is_embeddable')->default(true)->after('is_active');
            $table->json('embed_settings')->nullable()->after('is_embeddable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn(['custom_url', 'short_url', 'is_embeddable', 'embed_settings']);
        });
    }
};
