<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        if ($this->routeIs('Students.store')) {
            return [
                'name_ar' => ['required', 'max:15', 'min:3'],
                'name_en' => ['required', 'max:15', 'min:3'],
                'email' => ['required', 'email'],
                'password' => ['required'],
                'gender_id' => ['required'],
                'nationalitie_id' => ['required'],
                'blood_id' => ['required'],
                'Date_Birth' => ['required'],
                'Grade_id' => ['required'],
                'Classroom_id' => ['required'],
                'section_id' => ['required'],
                'parent_id' => ['required'],
                'academic_year' => ['required'],
            ];
        } else {
            return [
                'name_ar' => ['required', 'max:15', 'min:3'],
                'name_en' => ['required', 'max:15', 'min:3'],
                'email' => ['required', 'email'],
                'password' => [
                    'required',
                ],
                'gender_id' => ['required'],
                'nationalitie_id' => ['required'],
                'blood_id' => ['required'],
                'Date_Birth' => ['required'],
                'Grade_id' => ['required'],
                'Classroom_id' => ['required'],
                'section_id' => ['required'],
                'parent_id' => ['required'],
                'academic_year' => ['required'],
            ];
        }
    }

    public function messages()
    {
        if ($this->routeIs('Students.store')) {
            return [
                'name_ar.required' => 'name arbic is required',
                'name_ar.max' => 'the name arbic is maximum 15 letters',
                'name_ar.min' => 'the name arbic is minimum 3 letters',

                'name_en.required' => 'name englsh is required',
                'name_en.max' => 'the name englsh is maximum 15 letters',
                'name_en.min' => 'the name englsh is minimum 3 letters',

                'email.required' => 'the email is required',
                'email.email' => 'please enter an email correctly',

                'password.required' => 'password is required',
                'password.password' => 'please enter a password correctly',

                'gender_id.required' => 'gender is required',
                'nationalitie_id.required' => 'nationalitie  is required',

                'blood_type.required' => 'blood type is required',

                'Date_Birth.required' => 'Date Birth is required',
                'Date_Birth.date_format' => 'please enter a date format correctly',
                'Grade_id.required' => 'Grade is required',

                'Classroom_id.required' => 'Class is required',
                'section_id.required' => 'section is required',
                'parent_id.required' => 'parent is required',
                'academic_year.required' => 'this year is required',
            ];
        } else {
            return [
                'name_ar.required' => 'name arbic is required',
                'name_ar.max' => 'the name arbic is maximum 15 letters',
                'name_ar.min' => 'the name arbic is minimum 3 letters',

                'name_en.required' => 'name englsh is required',
                'name_en.max' => 'the name englsh is maximum 15 letters',
                'name_en.min' => 'the name englsh is minimum 3 letters',

                'email.required' => 'the email is required',
                'email.email' => 'please enter an email correctly',

                'password.required' => 'password is required',
                'password.password' => 'please enter a password correctly',

                'gender_id.required' => 'gender is required',
                'nationalitie_id.required' => 'nationalitie  is required',

                'blood_type.required' => 'blood type is required',

                'Date_Birth.required' => 'Date Birth is required',
                'Date_Birth.date_format' => 'please enter a date format correctly',
                'Grade_id.required' => 'Grade is required',

                'Classroom_id.required' => 'Class is required',
                'section_id.required' => 'section is required',
                'parent_id.required' => 'parent is required',
                'academic_year.required' => 'this year is required',
            ];
        }
    }
}
