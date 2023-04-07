<?php

namespace App\Http\Controllers\Classonline;

use App\Models\Grade;
use App\Models\Classonline;

use Illuminate\Http\Request;
use App\Http\traits\MeetingsZoom;
use App\Http\Controllers\Controller;

class ClassonlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use MeetingsZoom ;
    public function index()
    {
        $online_classes=Classonline::all();

        return view('pages.online_classes.index',compact('online_classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades=Grade::all();
        return view('pages.online_classes.add',compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

        $meeting = $this->createMeeting($request);
            Classonline::create([
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $meeting->id,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $meeting->duration,
            'password' => $meeting->password,
            'start_url' => $meeting->start_url,
            'join_url' => $meeting->join_url,
        ]);
        toastr()->success(trans('messages.success'));
        return redirect()->route('classonline.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
