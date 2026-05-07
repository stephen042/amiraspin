<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'tesla_balance',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'tesla_balance' => 'decimal:2',
    ];

    // RELATIONSHIPS

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
