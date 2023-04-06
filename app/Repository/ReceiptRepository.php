<?php

namespace App\Repository;

use App\Models\Fundaccount;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Receipt_student;
use App\Models\Student_account;
use Illuminate\Support\Facades\DB;
use App\Repository\ReceiptRepositoryInterface;

class ReceiptRepository implements ReceiptRepositoryInterface
{
    public function index()
    {
        $receipt_students = Receipt_student::all();
        return view('pages.Receipt.index', compact('receipt_students'));
    }
    public function name($id)
    {
        $student = Student::find($id);
        return view('pages.Receipt.add', compact('student'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $receipr = Receipt_student::create([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'debit' => $request->Debit,
                'description' => $request->description,
            ]);

            $Fundaccount = Fundaccount::create([
                'date' => date('Y-m-d'),
                'debit' => $request->Debit,
                'credit' => 0.0,
                'receipt_student_id' => $receipr->id,
                'description' => $request->description,
            ]);

            Student_account::create([
                'date' => date('Y-m-d'),
                'debit' => 0.0,
                'credit' => $request->Debit,
                'description' => $request->description,
                'type' => 'receipr',
                'receipt_student_id' => $receipr->id,
                'student_id' => $request->student_id,
            ]);

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('receipt.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $receipt_student= Receipt_student::findorFail($id);

        return view('pages.receipt.edit', compact('receipt_student'));
    }
    public function update(Request $request, $id)
    {
        $receipt = Receipt_student::findorFail($id);

        $receipt->update([
            'date' => date('Y-m-d'),
            'student_id' => $request->student_id,
            'debit' => $request->Debit,
            'description' => $request->description,
        ]);
        $Fundaccount = Fundaccount::where('receipt_student_id', $request->id)->first();
        $Fundaccount->update([
            'date' => date('Y-m-d'),
            'debit' => $request->Debit,
            'credit' => 0.0,
            'receipt_student_id' => $receipt->id,
            'description' => $request->description,
        ]);

        $Student_account = Student_account::where('receipt_student_id', $request->id)->first();
        $Student_account->update([
            'date' => date('Y-m-d'),
            'debit' => 0.0,
            'credit' => $request->Debit,
            'description' => $request->description,
            'type' => 'receipr',
            'receipt_student_id' => $receipt->id,
            'student_id' => $request->student_id,
        ]);

        toastr()->success(trans('messages.Update'));
        return redirect()->route('receipt.index');
    }


    public function delete($id)
    {
        Receipt_student::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('receipt.index');
    }
}
