<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\SpinAllocations;
use App\Models\SpinResults;
use App\Models\SpinHistories;
use App\Models\Wallets;
use App\Models\Withdrawals;
use App\Models\WithdrawalPins;

class SpinSystemSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // 🎡 Static prizes (same as frontend)
            $prizes = [
                ['label' => 'TESLA CAR', 'value' => '🚗', 'amount' => 1],
                ['label' => 'LOSE', 'value' => '❌', 'amount' => 0],
                ['label' => '$10,000', 'value' => '💰', 'amount' => 10000],
                ['label' => '$100,000', 'value' => '💎', 'amount' => 100000],
                ['label' => 'LOSE', 'value' => '❌', 'amount' => 0],
                ['label' => '$60,000', 'value' => '💵', 'amount' => 60000],
                ['label' => 'LOSE', 'value' => '❌', 'amount' => 0],
            ];

            // 👤 Create 5 test users
            User::factory(5)->create()->each(function ($user) use ($prizes) {

                // 💰 Create wallet
                $wallet = Wallets::create([
                    'user_id' => $user->id,
                    'balance' => 0,
                    'tesla_balance' => 0,
                ]);

                // 🎯 Create spin allocation
                $totalSpins = rand(3, 6);

                $allocation = SpinAllocations::create([
                    'user_id' => $user->id,
                    'total_spins' => $totalSpins,
                    'used_spins' => 0,
                    'is_active' => true,
                ]);

                // 🎡 Create spin results (admin-controlled outcomes)
                $results = collect();

                for ($i = 0; $i < $totalSpins; $i++) {

                    $prize = $prizes[array_rand($prizes)];

                    $result = SpinResults::create([
                        'user_id' => $user->id,
                        'spin_allocation_id' => $allocation->id,
                        'prize_label' => $prize['label'],
                        'prize_value' => $prize['value'],
                        'slice_index' => $i % count($prizes), // just for demo, can be random or based on label
                        'amount' => $prize['amount'],
                        'color' => null,
                        'is_used' => false,
                    ]);

                    $results->push([$result, $prize]);
                }

                // 🔥 Simulate some spins already used
                $usedCount = rand(1, $totalSpins - 1);

                for ($i = 0; $i < $usedCount; $i++) {

                    [$result, $prize] = $results[$i];

                    $result->update([
                        'is_used' => true,
                        'used_at' => now(),
                    ]);

                    // 🧾 History
                    SpinHistories::create([
                        'user_id' => $user->id,
                        'spin_result_id' => $result->id,
                        'result_label' => $result->prize_label,
                        'result_value' => $result->prize_value,
                        'amount' => $result->amount,
                    ]);

                    // 💰 Update wallet
                    if ($result->prize_label === 'TESLA CAR') {
                        $wallet->increment('tesla_balance', 1);
                    } elseif ($prize['amount'] > 0) {
                        $wallet->increment('balance', $prize['amount']);
                    }
                }

                // update used spins
                $allocation->update([
                    'used_spins' => $usedCount,
                ]);

                // 💸 Create withdrawal (if user has money)
                if ($wallet->balance > 0 || $wallet->tesla_balance > 0) {

                    $withdrawal = Withdrawals::create([
                        'user_id' => $user->id,
                        'withdrawal_method' => 'bank',
                        'amount' => min($wallet->balance, 5000),
                        'bank_details' => [
                            'account_name' => $user->name,
                            'account_number' => '1234567890',
                            'bank_name' => 'GTBank',
                        ],
                        'status' => 'pending',
                    ]);

                    // 🔐 Create 3-step pins
                    for ($step = 1; $step <= 3; $step++) {
                        WithdrawalPins::create([
                            'user_id' => $user->id,
                            'cot' => 'COT' . rand(100, 999),
                            'tax_code' => 'TAX' . rand(100, 999),
                            'token_code' => 'TOKEN' . rand(100, 999),
                        ]);
                    }
                }
            });
        });
    }
}