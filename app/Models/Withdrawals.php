<?php

namespace App\Models;

use App\Models\WithdrawalPins;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawals extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'withdrawal_method',
        'amount',
        'bank_details',
        'delivery_details',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'bank_details' => 'array',
        'delivery_details' => 'array',
    ];

    // RELATIONSHIPS

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pins()
    {
        return $this->hasMany(WithdrawalPins::class);
    }

    // SCOPES

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
