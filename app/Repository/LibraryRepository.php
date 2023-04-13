<?php
namespace App\Repository;

use App\Models\Grade;
use App\Models\Library;
use Illuminate\Http\Request;
use App\Http\traits\uploadfile;
use Illuminate\Support\Facades\Storage;
use App\Repository\LibraryRepositoryInterface;

class LibraryRepository implements LibraryRepositoryInterface
{
    use uploadfile;
    public function index()
    {
        $books = Library::all();
        return view('pages.library.index', compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create', compact('grades'));
    }

    public function store(Request $request)
    {
        Library::create([
            'title' => $request->title,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'teacher_id' => 1,
            'file' => $request->file('file_name')->getClientOriginalName(),
        ]);
        $this->uploadfiles($request->file_name, 'Library');

        toastr()->success(trans('messges.success'));
        return redirect()->route('library.index');
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = Library::find($id);
        return view('pages.library.edit', compact('grades', 'book'));
    }

    public function update(Request $request, $id)
    {
        $book = Library::findorFail($id);
        
        if ($request->hasfile('file_name')) {

            $exists = Storage::disk('upload_attachments')->exists('attachments/Library/',$book->file);
        
            if ($exists) {
                
                Storage::disk('upload_attachments')->delete('attachments/Library/'.$book->file);
                
            }
            $this->uploadfiles($request->file_name,'Library');
            
            $file_name_new = $request->file('file_name')->getClientOriginalName();
            // dd($file_name_new);
        }
        $book->update([
            'title' => $request->title,
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'teacher_id' => 1,
            'file' => $file_name_new,
        ]);

        toastr()->success(trans('messges.Update'));
        return redirect()->route('library.index');
    }

    public function destroy(Request $request, $id)
    {
        
        $exists = Storage::disk('upload_attachments')->exists('attachments/Library/',$request->file_name);
        
            if ($exists) {
                
                Storage::disk('upload_attachments')->delete('attachments/Library/'.$request->file_name);
                
            }
        Library::destroy($id);

        toastr()->success(trans('messges.Delete'));
        return redirect()->route('library.index');
    }

    public function download($filename)
    {
        return response()->download(public_path('attachments/Library/' . $filename));
    }
}
