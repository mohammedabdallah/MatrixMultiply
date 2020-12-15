<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsValidMetricsToMultiply implements Rule
{
    /**
     * Determine if the columns count in first matrix equal to second row matrix
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (count($value[1]) != count(request('second_matrix'))) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the column count in the first matrix should be equal to the row count of the second matrix';
    }
}
