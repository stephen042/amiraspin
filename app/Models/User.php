<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use App\Models\SpinAllocations;
use App\Models\SpinResults;
use App\Models\SpinHistories;
use App\Models\Wallets;
use App\Models\Withdrawals;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // RELATIONSHIPS

    public function spinAllocations()
    {
        return $this->hasMany(SpinAllocations::class);
    }


    public function spinResults()
    {
        return $this->hasMany(SpinResults::class);
    }

    public function spinHistories()
    {
        return $this->hasMany(SpinHistories::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallets::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawals::class);
    }

    public function withdrawalPins()
    {
        return $this->hasOne(WithdrawalPins::class);
    }
}
