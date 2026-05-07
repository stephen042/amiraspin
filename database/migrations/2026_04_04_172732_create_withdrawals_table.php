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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->enum('withdrawal_method', ['bank', 'cash', 'car']);
            $table->decimal('amount', 15, 2);

            $table->json('bank_details')->nullable(); //for bank transfer
            $table->json('delivery_details')->nullable(); // for cash delivery & car delivery

            $table->enum('status', ['pending','completed', 'rejected'])
                ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
