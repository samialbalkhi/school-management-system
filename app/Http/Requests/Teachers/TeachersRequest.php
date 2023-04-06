<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class TeachersRequest extends FormRequest
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
        if ($this->routeIs('Teachers.store')) {
            return [
                'Email' => ['required', 'email'],
                'Password' => ['required', 'max:15', 'min:8'],
                'Name_ar' => ['required', 'max:10', 'min:3'],
                'Name_en' => ['required', 'max:10', 'min:3'],
                'Specialization_id' => ['required'],
                'Gender_id' => ['required'],
                'Joining_Date' => ['required'],
                'Address' => ['required', 'max:20', 'min:5'],
            ];
        } else {
            return [
                'Email' => ['required', 'email'],
                'Password' => ['required', 'max:15', 'min:8'],
                'Name_ar' => ['required', 'max:10', 'min:3'],
                'Name_en' => ['required', 'max:10', 'min:3'],
                'Specialization_id' => ['required'],
                'Gender_id' => ['required'],
                'Joining_Date' => ['required'],
                'Address' => ['required', 'max:20', 'min:5'],
            ];
        }
    }

    public function messages()
    {
        if ($this->routeIs('Teachers.store')) {
            return [
                'Email.required' => 'The email is required',
                'Email.email' => 'please enter your email address',
                'Password.required' => 'The password is required',
                'Password.max' => 'The password is maximum 15 letters',
                'Password.min' => 'The password is minimum 8 letters',
                'Name_ar.required' => 'The name arbic is required',
                'Name_ar.max' => 'name arbic is maximum 10 letters',
                'Name_ar.min' => 'name arbic is minimum 3 letters',

                'Name_en.required' => 'The name englsh is required',
                'Name_en.max' => 'name englsh is maximum 10 letters',
                'Name_en.min' => 'name englsh is minimum 3 letters',
                'Specialization_id.required' => 'the specialization is required',
                'Gender_id.required' => 'gender is required',
                'Joining_Date.required' => 'date is required',
                'Address.required' => 'the address is required',
            ];
        } else {
            return [
                'Email.required' => 'The email is required',
                'Email.email' => 'please enter your email address',
                'Password.required' => 'The password is required',
                'Password.max' => 'The password is maximum 15 letters',
                'Password.min' => 'The password is minimum 8 letters',
                'Name_ar.required' => 'The name arbic is required',
                'Name_ar.max' => 'name arbic is maximum 10 letters',
                'Name_ar.min' => 'name arbic is minimum 3 letters',

                'Name_en.required' => 'The name englsh is required',
                'Name_en.max' => 'name englsh is maximum 10 letters',
                'Name_en.min' => 'name englsh is minimum 3 letters',
                'Specialization_id.required' => 'the specialization is required',
                'Gender_id.required' => 'gender is required',
                'Joining_Date.required' => 'date is required',
                'Address.required' => 'the address is required',
            ];
        }
    }
}
