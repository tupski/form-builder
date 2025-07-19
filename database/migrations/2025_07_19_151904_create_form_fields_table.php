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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->onDelete('cascade');
            $table->string('type'); // text, email, select, radio, checkbox, textarea, number, date, file
            $table->string('label');
            $table->string('name'); // field name for form submission
            $table->text('placeholder')->nullable();
            $table->text('help_text')->nullable();
            $table->boolean('required')->default(false);
            $table->integer('order')->default(0);
            $table->json('validation_rules')->nullable(); // Additional validation rules
            $table->json('options')->nullable(); // For select, radio, checkbox options
            $table->json('settings')->nullable(); // Field-specific settings
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
