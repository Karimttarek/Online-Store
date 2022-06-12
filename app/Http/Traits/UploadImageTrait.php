<?php

namespace App\Http\Traits;

use http\Env\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

Trait UploadImageTrait
{

    public function uploadImage($img , $folder){

        if ($img != null){
        $file_extention  = $img->getClientOriginalExtension();
        $file_name = $img->hashName();// .'.' . $file_extention
        $img->move($folder , $file_name);
        return $file_name;
        }
    }




    public function saveImg(Request $request ,$path,$img ){

//        $path = $request->file($img)->store('avatars');
    }
    public function deleteImage($img,$path){

        File::delete($path.$img);
    }

}
