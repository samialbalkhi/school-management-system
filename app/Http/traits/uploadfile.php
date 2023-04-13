<?php
namespace App\Http\traits;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait uploadfile
{
    public function uploadfiles($file, $folder)
    {
        $name = $file->getClientOriginalName();
        $file->storeAs('attachments/', $folder . '/' . $name,'upload_attachments');
        //    $file->storeAs('attachments/Library/',$name,'upload_attachments');
    }
    public function deletefile($name)
    {   
        $exists = Storage::disk('upload_attachments')->exists('attachments/Library/',$name);
        
        if ($exists) {
            // unlink('attachments/Library/'.$name);
            Storage::disk('upload_attachments')->delete('attachments/Library/'.$name);
            // Storage::disk('upload_attachments')->delete('attachments/Library/'.$name);
        }
    }
}
