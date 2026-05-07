<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpinResults extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spin_allocation_id',
        'prize_label',
        'prize_value',
        'amount',
        'slice_index',
        'color',
        'is_used',
        'used_at',
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'used_at' => 'datetime',
    ];

    //  RELATIONSHIPS

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spinAllocation()
    {
        return $this->belongsTo(SpinAllocations::class);
    }

    public function history()
    {
        return $this->hasOne(SpinHistories::class);
    }

    //  SCOPES

    public function scopeUnused($query)
    {
        return $query->where('is_used', false);
    }

    public function scopeUsed($query)
    {
        return $query->where('is_used', true);
    }

    //  HELPER

    public function isWin()
    {
        return $this->prize_label !== 'LOSE';
    }
}
