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
        Schema::create('spin_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('spin_allocation_id')->constrained()->cascadeOnDelete();

            $table->string('prize_label');   // e.g "$10,000", "LOSE"
            $table->string('prize_value');   // 💰, ❌, etc
            $table->integer('amount');   // 100000 , 0, etc
            $table->integer('slice_index'); // 0,1,2,3,4 
            $table->string('color')->nullable();

            $table->boolean('is_used')->default(false); // has user spun this?
            $table->timestamp('used_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spin_results');
    }
};
