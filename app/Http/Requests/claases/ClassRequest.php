<?php

namespace App\Http\Requests\claases;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
        if ($this->routeIs('classes.store')) {
            return [
                'List_Classes.*.Name' => ['required','max:25', 'min:3'],
                'List_Classes.*.Name_class_en' => ['required','max:25', 'min:3'],
                'List_Classes.*.grade_id' => ['required'],
            ];
        } else {
            return [
                'List_Classes.*.Name' => ['required',  'max:25', 'min:3'],
                'List_Classes.*.Name_class_en' => ['required','max:25', 'min:3'],
                'List_Classes.*.grade_id' => ['required'],
            ];
        }
    }
    public function messages()
    {
        if ($this->routeIs('classes.store')) {
            return [
                ///////////////////   Name          ////////////////
                'Name.required' =>trans('validation.required'),
                'Name.max' => 'The name is maximum 20 letters',
                'Name.min' => 'The name is minimum 3 letters',

                /////////////      Name_class_en           ////////////////

                'Name_class_en.required' => 'The name en  is required',
               
                'Name_class_en.max' => 'The name en is maximum 20 letters',
                'Name_class_en.min' => 'The name en is minimum 3 letters',

                /////////     grade_id            /////////////////

                'grade_id.required' => 'The grade en is required',
            ];
        } else {
            return [
                ///////////////////   Name          ////////////////
                'Name.required' => 'The name is required',
                'Name.max' => 'The name is maximum 20 letters',
                'Name.min' => 'The name is minimum 3 letters',

                /////////////      Name_class_en           ////////////////

                'Name_class_en.required' => 'The name en  is required',
                'Name_class_en.max' => 'The name en is maximum 20 letters',
                'Name_class_en.min' => 'The name en is minimum 3 letters',

                /////////     grade_id            /////////////////

                'grade_id.required' => 'The grade en is required',
            ];
        }
    }
}
