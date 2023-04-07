<?php
namespace App\Http\traits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;

trait MeetingsZoom
{
    public function createMeeting(Request $request)
    {
        $user = Zoom::user()->first();
        $meetingData = [
            'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_time' => $request->start_time,
            'timezone' => config('zoom.timezone'),
        ];
        $meeting = Zoom::meeting()->make($meetingData);
        dd($meeting);
        $meeting->settings()->make([
            'join_before_host' => false,
            'host_video' => false,
            'participant_video' => false,
            'mute_upon_entry' => true,
            'waiting_room' => true,
            'approval_type' => config('zoom.approval_type'),
            'audio' => config('zoom.audio'),
            'auto_recording' => config('zoom.auto_recording'),
        ]);

        return  $user->meetings()->save($meeting);
    }
}
