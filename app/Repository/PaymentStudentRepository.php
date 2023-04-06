<?php
namespace App\Repository;

use App\Models\Payment_student;
use App\Models\Student;
use App\Models\Student_account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repository\PaymentStudentRepositoryInterface;

class PaymentStudentRepository implements PaymentStudentRepositoryInterface
{
    public function index()
    {
        $ProcessingFees = Payment_student::all();
        return view('pages.PaymentStudent.index', compact('ProcessingFees'));
    }
    public function show($id)
    {
        $student = Student::findorFail($id);
        return view('pages.PaymentStudent.add', compact('student'));
    }
    public function edit($id)
    {
        $Payment_student = Payment_student::find($id);
        return view('pages.PaymentStudent.edit', compact('Payment_student'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $PaymentStudent = Payment_student::create([
                'date' => date('Y-m-d'),
                'amount' => $request->Debit,
                'description' => $request->description,
                'student_id' => $request->student_id,
            ]);

            Student_account::create([
                'date' => date('Y-m-d'),
                'type' => 'Payment_student',
                'student_id' => $request->student_id,
                'payment_student_id' => $PaymentStudent->id,
                'debit' => 0.0,
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);
            DB::commit();
            toastr()->success(trans('messges.success'));
            return redirect()->route('paymentStudent.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        //    dd($id);
        try {
            $Payment_student = Payment_student::findorfail($id);

            $Payment_student->update([
                'date' => date('Y-m-d'),
                'amount' => $request->Debit,
                'description' => $request->description,
                'student_id' => $request->student_id,
            ]);

            $Student_account = Student_account::where('payment_student_id', $id)->first();

            $Student_account->update([
                'date' => date('Y-m-d'),
                'type' => 'Payment_student',
                'student_id' => $request->student_id,
                'payment_student_id' => $Payment_student->id,
                'debit' => 0.0,
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(trans('messges.Update'));
            return redirect()->route('paymentStudent.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        Payment_student::destroy($id);
        toastr()->success(trans('messges.success'));
        return redirect()->route('paymentStudent.index');
    }
}
