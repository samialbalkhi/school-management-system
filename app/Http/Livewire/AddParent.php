<?php

namespace App\Http\Livewire;

use App\Models\Father;
use Livewire\Component;
use App\Models\Religion;
use App\Models\Type_blood;
use App\Models\Notionalitio;
use Illuminate\Support\Facades\Hash;


class AddParent extends Component
{

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
        $Religion_Father_id;

        public function updated($propertyName)
        {
            $this->validateOnly($propertyName, [
                'Email' => 'required|email',
                'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
                'Passport_ID_Father' => 'min:10|max:10',
                'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
                'Passport_ID_Mother' => 'min:10|max:10',
                'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
            ]);
        }

    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Notionalitio::all(),
            'Type_Bloods' => Type_blood::all(),
            'Religions' => Religion::all(),
        ]);
    }
    public function firstStepSubmit()
    {
       
        // $this->validate([
        //     'Email' => 'required|unique:fathers,Email,'.$this->id,
        //     'Password' => 'required',
        //     'Name_Father' => 'required',
        //     'Name_Father_en' => 'required',
        //     'Job_Father' => 'required',
        //     'Job_Father_en' => 'required',
        //     'National_ID_Father' => 'required|unique:fathers,National_ID_Father,' . $this->id,
        //     'Passport_ID_Father' => 'required|unique:fathers,Passport_ID_Father,' . $this->id,
        //     'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        //     'Nationality_Father_id' => 'required',
        //     'Blood_Type_Father_id' => 'required',
        //     'Religion_Father_id' => 'required',
        //     'Address_Father' => 'required',
        // ]);

       $this->currentStep = 2 ;
  

    }
   
    public function secondstepsubmit()
    {
        $this->validate([
            'Email' => 'required|unique:mothers,Email,'.$this->id,
            'Password' => 'required',
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:mothers,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:mothers,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function back($step)
    {

        $this->currentStep = $step;
    }

    public function submitForm()
    {

        Father::create([

            'email'=>$this->Email,
            'password'=>Hash::make($this->Password),
            'name' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
            'national_id'=>$this->National_ID_Father,
            'passport_id'=>$this->Passport_ID_Father,
            'phone'=>$this->Phone_Father,
            'job'=>['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
            'notionalitio_id'=>$this->Nationality_Father_id,
            'type_blood_id'=>$this->Blood_Type_Father_id,
            'religion_id'=>$this->Religion_Father_id,
            'address'=>$this->Address_Father,
        ]);
    }
  

   
    
    
}
