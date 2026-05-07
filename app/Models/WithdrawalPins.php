<?php

namespace App\Models;

use App\Models\Withdrawals;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalPins extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'step',
        'cot',
        'tax_code',
        'token_code',
    ];

    // 🔗 RELATIONSHIPS

    public function withdrawal()
    {
        return $this->belongsTo(Withdrawals::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
