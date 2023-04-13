<?php

namespace App\Http\Controllers\Teachers\dashbord;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $information = Teacher::findorFail(auth()->user()->id);
        return view('pages.Teacher.dashboard.profile.profile', compact('information'));
    }
    public function update(Request $request, $id)
    {
        $Teacher = Teacher::findOrFail($id);

        if (!empty($request->password)) {
            $Teacher->update([
                'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'password' => Hash::make($request->password),
            ]);
        } else {
            $Teacher->update([
                'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
            ]);
        }
        toastr()->success(trans('messges.Update'));
        return redirect()->back();
    }
}
