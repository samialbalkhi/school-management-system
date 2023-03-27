<?php

namespace App\Http\Livewire;

use App\Models\Father;
use App\Models\Mother;
use Livewire\Component;
use App\Models\Religion;
use App\Models\Type_blood;
use App\Models\Notionalitio;
use Illuminate\Support\Facades\Hash;

class AddParent extends Component
{
    public $successMessage = '';

    public $catchError;

    public $currentStep = 1,
        // Father_INPUTS
        $Email,
        $Password,
        $Name_Father,
        $Name_Father_en,
        $National_ID_Father,
        $Passport_ID_Father,
        $Phone_Father,
        $Job_Father,
        $Job_Father_en,
        $Nationality_Father_id,
        $Blood_Type_Father_id,
        $Address_Father,
        $Religion_Father_id,
        // Mother_INPUTS
        $Name_Mother,
        $Name_Mother_en,
        $National_ID_Mother,
        $Passport_ID_Mother,
        $Phone_Mother,
        $Job_Mother,
        $Job_Mother_en,
        $Nationality_Mother_id,
        $Blood_Type_Mother_id,
        $Address_Mother,
        $Religion_Mother_id;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);
    }

    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Notionalitio::all(),
            'Type_Bloods' => Type_Blood::all(),
            'Religions' => Religion::all(),
        ]);
    }

    //firstStepSubmit
    public function firstStepSubmit()
    {
        $this->validate([
            'Email' => 'required|unique:fathers,Email,' . $this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:fathers,national_id,' . $this->id,
            'Passport_ID_Father' => 'required|unique:fathers,passport_id,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);

        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {
        $this->currentStep = 3;
    }

    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }
    public function submitForm()
    {
        Father::create([

            'email' => $this->Email,
            'password' => Hash::make($this->Password),
            'name' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
           'national_id' => $this->National_ID_Father,
            'passport_id' => $this->Passport_ID_Father,
            'phone' => $this->Phone_Father,
            'job' =>['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
          'notionalitio_id' => $this->Nationality_Father_id,
           'type_blood_id' => $this->Blood_Type_Father_id,
           'religion_id' => $this->Religion_Father_id,
           'address' => $this->Address_Father,
        ]);

        Mother::create([
            'email' => $this->Email,
            'password' => Hash::make($this->Password),
            'name' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
           'national_id' => $this->National_ID_Mother,
            'passport_id' => $this->Passport_ID_Mother,
            'phone' => $this->Phone_Mother,
            'job' =>['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
          'notionalitio_id' => $this->Nationality_Mother_id,
           'type_blood_id' => $this->Blood_Type_Mother_id,
           'religion_id' => $this->Religion_Mother_id,
           'address' => $this->Address_Mother,
        ]);

        $this->successMessage = trans('messages.success');
        $this->clearForm();
        $this->currentStep = 1;
    }

    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father ='';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father ='';
        $this->Religion_Father_id ='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';

    }
}
