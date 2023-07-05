<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    function saveImage($photo,$folder)
    {
        if ($photo) {
            //save photo in folder
            $file_extension = $photo->getClientOriginalExtension();
//            $file_extension = $photo->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = $folder;
            $photo->move($path, $file_name);

            return $file_name;
        }
        return null;
    }
    public function uploadFile($request,$name,$folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/',$folder.'/'.$file_name,'upload_attachments');
    }

    public function deleteFile($folder,$id)
    {

        $exists = Storage::disk('upload_attachments')->exists('attachments/'.$folder.'/'.$id);
//       $image_path = public_path(). 'attachments/'.$folder.'/'.Auth::user()->club_id.'/'.$name;
//        unlink($image_path);
        if($exists)
        {
            Storage::disk('upload_attachments')->deleteDirectory('attachments/'.$folder.'/'.$id);
        }
    }


}
