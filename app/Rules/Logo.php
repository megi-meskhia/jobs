<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Logo implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        return $value->isValid() && in_array($value->extension(), ['jpeg', 'png', 'jpg', 'gif', 'svg']);
    }

    public function message()
    {
        return 'The :attribute must be a valid image file.';
    }
}
