<?php
namespace App\Repository;

use App\Models\Fee;
use App\Models\Fees_invoice;
use App\Models\Student;
use App\Models\Student_account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repository\FeesinvoicesRepositoryInterface;
use Exception;

class FeesinvoicesRepository implements FeesinvoicesRepositoryInterface
{
    public function index()
    {
        $Fee_invoices = Fees_invoice::all();

        return view('pages.Fees_Invoices.index', compact('Fee_invoices'));
    }
    public function show($id)
    {
        $student = Student::findorFail($id);
        $fees = Fee::where('classroom_id', $student->classroom_id)->get();

        return view('pages.Fees_Invoices.add', compact('student', 'fees'));
    }
    public function store(Request $request)
    {
        $List_Fee = $request->List_Fees;
        DB::beginTransaction();
        try {
            foreach ($List_Fee as $items) {
                $fees_inv = Fees_invoice::create([
                    'date' => date('Y-m-d'),
                    'student_id' => $items['student_id'],
                    'grade_id' => $request->Grade_id,
                    'classroom_id' => $request->Classroom_id,
                    'fee_id' => $items['fee_id'],
                    'amount' => $items['amount'],
                    'description' => $items['description'],
                ]);

                Student_account::create([
                    'date'=>date('Y-m-d'),
                    'student_id' => $items['student_id'],
                    'type' => 'invoice',
                    'fees_invoice_id' => $fees_inv->id,
                    'debit' => $items['amount'],
                    'credit' => 0.0,
                    'description' => $items['description'],
                ]);
            }

            DB::commit();

            toastr()->success(trans('messges.success'));
            return redirect()->route('feesinvoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $fee_invoices = Fees_invoice::find($id);
        $fee = Fee::where('classroom_id', $fee_invoices->classroom_id)->get();
        return view('pages.Fees_Invoices.edit', compact('fee_invoices', 'fee'));
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $fee_invoices = Fees_invoice::findorFail($id);

            $fee_invoices->update([
                'fee_id' => $request->fee_id,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            $studentacount = Student_account::where('fees_invoice_id', $request->id)->first();
            $studentacount->update([
                'debit' => $request->amount,
                'description' => $request->description,
            ]);
            DB::commit();

            toastr()->success(trans('messges.Update'));
            return redirect()->route('feesinvoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        Fees_invoice::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('feesinvoices.index');
    }
}
