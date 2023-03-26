<?php

namespace App\Http\Requests\Section;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
        if($this->routeIs('Sections.store')){

            return [
                
                'Name_Section_Ar'=>['required','max:20','min:1'],
                'Name_Section_En'=>['required','max:20','min:1'],
                'Grade_id'=>['required'],
                'Class_id'=>['required'],
            ];
        }else{
            return [
                
                'Name_Section_Ar'=>['required','max:20','min:1'],
                'Name_Section_En'=>['required','max:20','min:1'],
                'Grade_id'=>['required'],
                'Class_id'=>['required'],
            ];
        }
    }
    public function messages()
    {
        if($this->routeIs('Sections.store')){

            return [
                'Name_Section_Ar.required'=>'The name arbic is required',
                'Name_Section_Ar.max'=>'The name max 20 letters',
                'Name_Section_Ar.min'=>'The name min 3 letters',
                
                'Name_Section_En.required'=>'The name arbic is required',
                'Name_Section_En.max'=>'The name max 20 letters',
                'Name_Section_En.min'=>'The name min 3 letters',
                
                'Grade_id.required'=>'The grade is required',
                'Class_id.required'=>'The class is required',
                
                
            ];
        }else{
            return [
                'Name_Section_Ar.required'=>'The name arbic is required',
                'Name_Section_Ar.max'=>'The name max 20 letters',
                'Name_Section_Ar.min'=>'The name min 3 letters',
                
                'Name_Section_En.required'=>'The name arbic is required',
                'Name_Section_En.max'=>'The name max 20 letters',
                'Name_Section_En.min'=>'The name min 3 letters',
                
                'Grade_id.required'=>'The grade is required',
                'Class_id.required'=>'The class is required',
                
                
            ];
        }
    }
}
