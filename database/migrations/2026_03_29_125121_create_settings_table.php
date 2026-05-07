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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // Core system configs
            $table->string('wincode')->default('W588TUZH');

            // Contact / system info
            $table->string('support_email')->nullable();
            $table->string('support_phone')->nullable();

            // Feature toggles
            $table->boolean('registration_enabled')->default(true);
            $table->boolean('maintenance_mode')->default(false);

            // Limits / configs
            $table->integer('max_upload_size')->default(2048); // in KB
            $table->integer('max_users')->nullable();

            // Optional metadata (future-proof)
            $table->json('meta')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
