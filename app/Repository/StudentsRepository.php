<?php
namespace App\Repository;

use App\Models\Grade;
use App\Models\Father;
use App\Models\Gender;
use App\Models\Mother;
use App\Models\Section;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Image;
use App\Models\Type_blood;
use App\Models\Notionalitio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentsRepository implements StudentsRepositoryInterface
{
    public function create()
    {
        $data['genders'] = Gender::all();
        $data['grad'] = Grade::all();
        $data['parents_Father'] = Father::all();
        $data['parents_Mother'] = Mother::all();
        $data['nationals'] = Notionalitio::all();
        $data['bloods'] = Type_blood::all();
        $data['classrooms'] = Classroom::all();
        $data['section'] = Section::all();

        return view('pages.Students.add', $data);
    }
    public function getclassesroom($id)
    {
        $list_classess = Classroom::where('grade_id', $id)->pluck('name', 'id');
        return $list_classess;
    }
    public function getsection($id)
    {
        return Section::where('classroom_id', $id)->pluck('name', 'id');
    }
    public function stor(Request $request)
    {
        DB::beginTransaction();
        try {
            $Student = Student::create([
                'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender_id' => $request->gender_id,
                'notionalitio_id' => $request->nationalitie_id,
                'type_blood_id' => $request->blood_id,
                'barth_day' => $request->Date_Birth,
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'father_id' => $request->parent_id,
                'academic_year' => $request->academic_year,
            ]);

            $students = $Student->name;

            if (!empty($request->photos)) {
                for ($i = 0; $i < count($request->photos); $i++) {
                    $path = $request->photos[$i]->store($students, 'public');
                    $Student->images()->create([
                        'name' => $path,
                    ]);
                }
            }
            DB::commit();
            toastr()->success(trans('messges.success'));
            return redirect()->route('Students.create');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function getstudents()
    {
        $students = Student::all();

        return view('pages.Students.index', compact('students'));
    }

    public function edti($id)
    {
        $parents = Father::all();
        $Grades = Grade::all();
        $bloods = Type_blood::all();
        $nationals = Notionalitio::all();
        $Genders = Gender::all();
        $Students = Student::find($id);
        return view('pages.Students.edit', compact('Students', 'Genders', 'nationals', 'bloods', 'Grades', 'parents'));
    }
    public function update(Request $request, $id)
    {
        $update = Student::findorFail($id);

        $update->update([
            'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender_id' => $request->gender_id,
            'notionalitio_id' => $request->nationalitie_id,
            'type_blood_id' => $request->blood_id,
            'barth_day' => $request->Date_Birth,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'father_id' => $request->parent_id,
            'academic_year' => $request->academic_year,
        ]);

        toastr()->success(trans('messges.Update'));
        return redirect()->route('Students.index');
    }
    public function delete($id)
    {
        Student::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('Students.index');
    }

    public function show($id)
    {
        $Student = Student::findorFail($id);
        // dd($Student->images);
        return view('pages.Students.show', compact('Student'));
    }

    public function attachments(Request $request)
    {
        //name images
        // $image=$request->photos[$i];
        // $namefile=$image->getClientOriginalName();

        $Student = Student::find($request->student_id);
        if (!empty($request->photos)) {
            for ($i = 0; $i < count($request->photos); $i++) {
                $path = $request->photos[$i]->store($request->student_name,'public');

                $Student->images()->create([
                    'name' => $path,
                ]);
            }

            toastr()->success(trans('messges.success'));
            return redirect()->route('Students.show', $request->student_id);
        }
    }

    public function Download_attachment($studentsname,$filename)
    {
        return Storage::download('storage/'.$studentsname.'/'.$filename);
        // return response()->download(public_path('storage/'.$studentsname.'/'.$filename));
    }

    public function delete_attachment(Request $request,$id)
    {
            Storage::delete('storage/'.$request->student_name.'/'.$request->filename);

            Image::where('id',$id)->where('name',$request->filename)->delete();

            toastr()->success(trans('messges.Delete'));
            return redirect()->route('Students.show', $request->student_id);
    }
}
