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
        Schema::create('conditional_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->onDelete('cascade');
            $table->foreignId('target_field_id')->constrained('form_fields')->onDelete('cascade'); // Field to show/hide
            $table->foreignId('condition_field_id')->constrained('form_fields')->onDelete('cascade'); // Field that triggers condition
            $table->enum('operator', ['equals', 'not_equals', 'contains', 'not_contains', 'greater_than', 'less_than']);
            $table->string('condition_value'); // Value to compare against
            $table->enum('action', ['show', 'hide'])->default('show');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conditional_rules');
    }
};
