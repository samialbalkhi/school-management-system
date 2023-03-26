<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule ;

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
        if($this->routeIs('grades.store')){

            return [
                'Name'=>['required','max:20','min:3','unique:grades,name'],
                'Name_en'=>['required','max:20','min:3','unique:grades,name'],
                'Notes'=>['max:20','min:3','nullable'],
    
            ];
        }else{

            return [
                'Name'=>['required','max:20','min:3','unique:grades,name',Rule::unique('grades','name')->ignore($this->route()->id)],
                'Name_en'=>['required','max:20','min:3','unique:grades,name',Rule::unique('grades','name')->ignore($this->route()->id)],
                'Notes'=>['max:20','min:3','nullable'],
    
            ];
        }
       
    }
    public function messages()
    {
        if($this->routeIs('grades.store')){
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
        
        }else{

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
}
