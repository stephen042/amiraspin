<?php

namespace App\Models;

use App\Models\SpinResults;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpinHistories extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spin_result_id',
        'result_label',
        'result_value',
        'amount'
    ];

    // RELATIONSHIPS

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spinResult()
    {
        return $this->belongsTo(SpinResults::class);
    }
}
