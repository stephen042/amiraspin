<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidWincode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!DB::table('settings')
            ->where('wincode', $value)
            ->exists()) {
            $fail('The :attribute is invalid.');
        }
    }
    
    public function message()
    {
        return 'Wincode does not exist.';
    }
}
