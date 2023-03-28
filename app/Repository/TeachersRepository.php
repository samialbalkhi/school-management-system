<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;


class TeachersRepository implements TeachersRepositoryInterface
{
    public function getteaches()
    {
        return Teacher::all();
    }

    public function getspecialization()
    {
        return Specialization::all();
    }
    public function getgenders()
    {
        return Gender::all();
    }

    public function storteacher($request)
    {
        Teacher::create([
            'email' => $request->Email,
            'password' =>Hash::make($request->Password),
            'name' => ['en'=>$request->Name_en, 'ar'=>$request->Name_ar],
            'specialization_id'=>$request->Specialization_id ,
            'gender_id'=>$request->Gender_id ,
            'joining_date'=>$request->Joining_Date ,
            'address'=>$request->Address ,
        ]);
        toastr()->success(trans('messges.success'));
        return redirect()->route('Teachers.create');
    }

    public function edit($id){
      
      return  Teacher::find($id);
    }

    public function update($id,$request)
    {
      $Teacher=Teacher::find($id);
      $Teacher->update([

        'email' => $request->Email,
            'password' =>Hash::make($request->Password),
            'name' => ['en'=>$request->Name_en, 'ar'=>$request->Name_ar],
            'specialization_id'=>$request->Specialization_id ,
            'gender_id'=>$request->Gender_id ,
            'joining_date'=>$request->Joining_Date ,
            'address'=>$request->Address ,
      ]);
      toastr()->success(trans('messges.Update'));
      return redirect()->route('Teachers.index');
    }

    public function delete($id){
        Teacher::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('Teachers.index');
    }
}
