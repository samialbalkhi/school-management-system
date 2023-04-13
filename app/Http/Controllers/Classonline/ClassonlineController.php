<?php

namespace App\Http\Controllers\Classonline;

use Carbon\Carbon;
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
    use MeetingsZoom;
    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;
    public function index()
    {
        $online_classes = Classonline::all();

        return view('pages.online_classes.index', compact('online_classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.add', compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = date('d-m-Y H:i:s', strtotime($request->start_time));
        $meetings = $this->createzoom($request->all());
        dd($meetings['data']);
        $getDate = Carbon::parse($date);
        Classonline::create([
            'grade_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'meeting_id' => $meetings['data']['id'],
            'topic' => $meetings['data']['topic'],
            'start_at' => $getDate,
            'duration' => $meetings['data']['duration'],
            'password' => $meetings['data']['password'],
            'start_url' => $meetings['data']['start_url'],
            'join_url' => $meetings['data']['join_url'],
            'email' => 'samialbalkhi766@gmail.com',
        ]);
        // dd()
        // toastr()->success(trans('messages.success'));
        return redirect()->route('classonline.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $meeting = $this->get($id);
        return view('meetings.index', compact('meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($meeting, Request $request, string $id)
    {
        // $this->update($meeting->zoom_meeting_id, $request->all());

        // return redirect()->route('meetings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        //   dd( $this->delete($meeting->$id));

        // return $this->sendSuccess('Meeting deleted successfully.');
    }
    public function deletes(Request $request, $id)
    {
        
       $path= $this->delete($id);
        dd($path);
        Classonline::where('meeting_id', $id)->delete();
        return redirect()->route('classonline.index');
    }
}
