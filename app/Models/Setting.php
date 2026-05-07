<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'wincode',
        'support_email',
        'support_phone',
        'registration_enabled',
        'maintenance_mode',
        'max_upload_size',
        'max_users',
        'meta',
    ];

    protected $casts = [
        'registration_enabled' => 'boolean',
        'maintenance_mode' => 'boolean',
        'meta' => 'array',
    ];

    /**
     * Get single settings row (singleton pattern)
     */
    public static function getSettings()
    {
        return self::first() ?? self::create([]);
    }
}
