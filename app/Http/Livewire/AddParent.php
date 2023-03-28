<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use App\Models\Father;
use App\Models\Mother;
use Livewire\Component;
use App\Models\Religion;
use App\Models\Type_blood;
use App\Models\Notionalitio;
use App\Models\Parent_attachment;

use Illuminate\Support\Facades\Hash;

class AddParent extends Component
{
    use WithFileUploads;
    public $photos;
    public $successMessage = '';
    public $Parent_id;
    public $show_table = true;
    public $catchError,
        $updateMode = false;

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
        $Religion_Mother_id,

        $futher=[];

    public function updated($propertyName)
    {
        // $this->validateOnly($propertyName, [
        //     'Email' => 'required|email',
        //     'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
        //     'Passport_ID_Father' => 'min:10|max:10',
        //     'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        //     'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
        //     'Passport_ID_Mother' => 'min:10|max:10',
        //     'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        // ]);
       
    }

    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Notionalitio::all(),
            'Type_Bloods' => Type_Blood::all(),
            'Religions' => Religion::all(),
            'parent_father' =>Father::all(),
            'parent_mother'=>Mother::all(),
        ]);
    }

    //firstStepSubmit
    public function firstStepSubmit()
    {
        // $this->validate([
        //     'Email' => 'required|unique:fathers,Email,' . $this->id,
        //     'Password' => 'required',
        //     'Name_Father' => 'required',
        //     'Name_Father_en' => 'required',
        //     'Job_Father' => 'required',
        //     'Job_Father_en' => 'required',
        //     'National_ID_Father' => 'required|unique:fathers,national_id,' . $this->id,
        //     'Passport_ID_Father' => 'required|unique:fathers,passport_id,' . $this->id,
        //     'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        //     'Nationality_Father_id' => 'required',
        //     'Blood_Type_Father_id' => 'required',
        //     'Religion_Father_id' => 'required',
        //     'Address_Father' => 'required',
        // ]);
       
        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {
        $this->currentStep = 3;
    }

    public function showformadd(){
        $this->show_table = false;
    }

    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }
    public function submitForm()
    {
        try {
            $father = Father::create([
                'email' => $this->Email,
                'password' => Hash::make($this->Password),
                'name' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'national_id' => $this->National_ID_Father,
                'passport_id' => $this->Passport_ID_Father,
                'phone' => $this->Phone_Father,
                'job' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
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
                'job' => ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
                'notionalitio_id' => $this->Nationality_Mother_id,
                'type_blood_id' => $this->Blood_Type_Mother_id,
                'religion_id' => $this->Religion_Mother_id,
                'address' => $this->Address_Mother,
            ]);

            $father_id = $father->id;
            if (!empty($this->photos)) {
                for ($i = 0; $i < count($this->photos); $i++) {
                    $path = $this->photos[$i]->store($this->National_ID_Father, 'public');

                    Parent_attachment::create([
                        'name' => $path,
                        'father_id' => $father_id,
                    ]);
                }
            }
            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }

    public function editMother($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $mother=Mother::find($id);
        $this->Parent_id = $id;
        $this->Email = $mother->email;
        $this->Password = $mother->password;
        $this->Name_Mother = $mother->getTranslation('name', 'ar');
        $this->Name_Mother_en = $mother->getTranslation('name', 'en');
        $this->Job_Mother = $mother->getTranslation('job', 'ar');;
        $this->Job_Mother_en = $mother->getTranslation('job', 'en');
        $this->National_ID_Mother =$mother->national_id;
        $this->Passport_ID_Mother = $mother->passport_id;
        $this->Phone_Mother = $mother->phone;
        $this->Nationality_Mother_id = $mother->notionalitio_id;
        $this->Blood_Type_Mother_id = $mother->type_blood_id;
        $this->Address_Mother =$mother->address;
        $this->Religion_Mother_id =$mother->religion_id;
        // dd($mother);
    }
    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $father=Father::find($id);
     ///  array_push($this->father, ...$father);
        $this->Parent_id = $id;
        $this->Email = $father->email;
        $this->Password = $father->password;
        $this->Name_Father = $father->getTranslation('name', 'ar');
        $this->Name_Father_en = $father->getTranslation('name', 'en');
        $this->Job_Father = $father->getTranslation('job', 'ar');;
        $this->Job_Father_en = $father->getTranslation('job', 'en');
        $this->National_ID_Father =$father->national_id;
        $this->Passport_ID_Father = $father->passport_id;
        $this->Phone_Father = $father->phone;
        $this->Nationality_Father_id = $father->notionalitio_id;
        $this->Blood_Type_Father_id = $father->type_blood_id;
        $this->Address_Father =$father->address;
        $this->Religion_Father_id =$father->religion_id;

        

    }
    public function editname($id)
    {
        $mother=Mother::find($id);
        $this->Parent_id = $id;
        $this->Email = $mother->email;
        $this->Password = $mother->password;
        $this->Name_Mother = $mother->getTranslation('name', 'ar');
        $this->Name_Mother_en = $mother->getTranslation('name', 'en');
        $this->Job_Mother = $mother->getTranslation('job', 'ar');;
        $this->Job_Mother_en = $mother->getTranslation('job', 'en');
        $this->National_ID_Mother =$mother->National_ID_Mother;
        $this->Passport_ID_Mother = $mother->Passport_ID_Mother;
        $this->Phone_Mother = $mother->Phone_Mother;
        $this->Nationality_Mother_id = $mother->Nationality_Mother_id;
        $this->Blood_Type_Mother_id = $mother->Blood_Type_Mother_id;
        $this->Address_Mother =$mother->Address_Mother;
        $this->Religion_Mother_id =$mother->Religion_Mother_id;
    }

    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;

    }
    public function submitForm_edit(){

        if ($this->Parent_id){
            $parent = Father::find($this->Parent_id);
            $parent->update([
                'email' => $this->Email,
                'password' => Hash::make($this->Password),
                'name' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'national_id' => $this->National_ID_Father,
                'passport_id' => $this->Passport_ID_Father,
                'phone' => $this->Phone_Father,
                'job' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                'notionalitio_id' => $this->Nationality_Father_id,
                'type_blood_id' => $this->Blood_Type_Father_id,
                'religion_id' => $this->Religion_Father_id,
                'address' => $this->Address_Father,
            ]);

        }

        return redirect()->to('/addparents');
    }

    public function delete($id)
    {
        Father::destroy($id);
        // return redirect()->to('/addparents');

    }

    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father = '';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father = '';
        $this->Religion_Father_id = '';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother = '';
        $this->Religion_Mother_id = '';
    }
}
