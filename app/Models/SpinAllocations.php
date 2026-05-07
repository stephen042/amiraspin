<?php

namespace App\Models;

use App\Models\SpinResults;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpinAllocations extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_spins',
        'used_spins',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // RELATIONSHIPS

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spinResults()
    {
        return $this->hasMany(SpinResults::class);
    }

    // HELPER

    public function remainingSpins()
    {
        return $this->total_spins - $this->used_spins;
    }

    public function isExhausted()
    {
        return $this->used_spins >= $this->total_spins;
    }
}
