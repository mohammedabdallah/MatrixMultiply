<?php

namespace App\Http\Requests;

use App\Rules\IsValidMetricsToMultiply;
use Illuminate\Foundation\Http\FormRequest;

class MultiplyMatrixRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_matrix' => ['required',new IsValidMetricsToMultiply],
            'second_matrix' => 'required'
        ];
    }
}
