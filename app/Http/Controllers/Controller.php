<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public  function images($image,$oldimage){
        if ($image) {
            if ($oldimage){
                $oldfile = $oldimage;
                $oldfilename = public_path('/'). $oldfile;
                File::delete($oldfilename);
            }


            $file= $image;
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('Image/'), $filename);

            return  'Image/' . $filename;;

        }

    }


}
