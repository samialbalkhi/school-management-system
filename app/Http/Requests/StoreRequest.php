<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'Name'=>['required','alpha','max:20','min:3','unique:grades,name'],
            'Name_en'=>['required','alpha','max:20','min:3','unique:grades,name'],
            'Notes'=>['alpha','max:20','min:3','nullable'],

        ];
    }
    public function messages()
    {
        return [
                /////////////    NAME ar          ////////////////////////// 
            'Name.required'=>trans('validation.required'),
            'Name.alpha'=>trans('validation.alpha'),
            'Name.max'=>trans('validation.max'),
            'Name.min'=>trans('validation.min'),
            'Name.unique'=>trans('validation.unique'),
           
                /////////////    NAME en       ////////////////////////// 
                'Name_en.required'=>trans('validation.required'),
                'Name_en.alpha'=>trans('validation.alpha'),
                'Name_en.max'=>trans('validation.max'),
                'Name_en.min'=>trans('validation.min'),
                'Name_en.unique'=>trans('validation.unique'),

                //////////////      NOTES        ////////////////////
                'Notes.required'=>trans('validation.required'),
                'Notes.alpha'=>trans('validation.alpha'),
                'Notes.max'=>trans('validation.max'),
                'Notes.min'=>trans('validation.min'),
        ];
    }
}
