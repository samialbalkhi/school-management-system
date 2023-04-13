<?php

namespace App\Http\Controllers\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;

use App\Http\traits\uploadfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use uploadfile;
    public function index()
    {
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('pages.setting.index', $setting);
    }
    public function update(Request $request)
    {
        $info = $request->except('_token', '_method', 'logo');
        foreach ($info as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        if ($request->hasFile('logo')) {
            $exists = Storage::disk('upload_attachments')->exists('attachments/logo/', $request->file_name);

            if ($exists) {
                Storage::disk('upload_attachments')->delete('attachments/logo/' . $request->file_name);
            }

            $logo_name = $request->file('logo')->getClientOriginalName();

            Setting::where('key', 'logo')->update(['value' => $logo_name]);

            $this->uploadfiles($request->logo, 'logo');
        }
        toastr()->success(trans('messges.Update'));
        return redirect()->back();
    }
}
