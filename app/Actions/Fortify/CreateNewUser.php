<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use App\Models\Wallets;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Rules\ValidWincode;
use App\Mail\WelcomeUserMail;
use Illuminate\Support\Facades\Mail;
use Log;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordSimpleRules(),
            'wincode' => $this->wincodeRules(),
        ])->validate();

        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
        ]);

        $user = User::latest()->first();

        try {
            // Send to the authenticated user
            Mail::to($user->email)->send(new WelcomeUserMail($user));
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            Log::error('Failed to send welcome email: ' . $e->getMessage());
        }

        Wallets::create([
            'user_id' => User::latest()->first()->id,
            'balance' => 0.00,
            'tesla_balance' => 0.00,
        ]);

        return $user;
    }

    protected function wincodeRules(): array
    {
        return [
            'required',
            'string',
            'max:255',
            new ValidWincode,
        ];
    }

    protected function passwordSimpleRules(): array
    {
        return [
            'required',
            'min:6',
            'max:255',
        ];
    }
}
