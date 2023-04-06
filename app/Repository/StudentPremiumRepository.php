<?php
namespace App\Repository;

use App\Models\Fundaccount;
use App\Models\Student;
use App\Models\Student_account;
use App\Models\Student_premium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repository\StudentPremiumRepositoryInterface;

class StudentPremiumRepository implements StudentPremiumRepositoryInterface
{
    public function index()
    {
        $Student_premium = Student_premium::all();

        return view('pages.StudentPremium.index', compact('Student_premium'));
    }
    public function show($id)
    {
        $student = Student::findorFail($id);

        return view('pages.StudentPremium.add', compact('student'));
    }
    public function edit($id)
    {
        $Student_premium = Student_premium::findOrFail($id);

        return view('pages.StudentPremium.edit', compact('Student_premium'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        // dd($request);
        try {
            $Student_premium = Student_premium::create([
                'date' => date('Y-m-d'),
                'amount' => $request->Debit,
                'student_id' => $request->student_id,
                'description' => $request->description,
            ]);

            Fundaccount::create([
                'date' => date('Y-m-d'),
                'student_premium_id' => $Student_premium->id,
                'debit' => 0.0,
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);

            Student_account::create([
                'date' => date('Y-m-d'),
                'type' => 'Student premium',
                'student_id' => $request->student_id,
                'student_premium_id' => $Student_premium->id,
                'debit' => $request->Debit,
                'credit' => 0.0,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('StudentPremium.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update(Request $request,$id)
    {
        DB::beginTransaction();

            // dd($request->id);
        try {
            $Student_premium = Student_premium::findOrFail($id);
          
            $Student_premium->update([
                'date' => date('Y-m-d'),
                'amount' => $request->Debit,
                'student_id' => $request->student_id,
                'description' => $request->description,
            ]);

            $fund_accounts = Fundaccount::where('student_premium_id',$id)->first();

            $fund_accounts->update([
                'date' => date('Y-m-d'),
                'student_premium_id' => $Student_premium->id,
                'debit' => 0.0,
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);

            $students_accounts = Student_account::where('student_premium_id',$id)->first();
                // dd($students_accounts);
            $students_accounts->update([
                'date' => date('Y-m-d'),
                'type' => 'Student premium',
                'student_id' => $request->student_id,
                'payment_student_id' => $Student_premium->id,
                'debit' => $request->Debit,
                'credit' => 0.0,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(trans('messges.Update'));
            return redirect()->route('StudentPremium.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        Student_premium::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('StudentPremium.index');
    }
}
