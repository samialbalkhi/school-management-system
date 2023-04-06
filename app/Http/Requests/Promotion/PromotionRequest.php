<?php

namespace App\Http\Requests\Promotion;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            
                'Grade_id'=>['required'],
                'academic_year'['required'],
        ];
    }
    public function messages()
    {
        return [

                'Grade_id'=>'the grade is required',
                'academic_year'=>'the year is required',
        ];
    }
}
