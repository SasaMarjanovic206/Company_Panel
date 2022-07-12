<?php

namespace App\Traits;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
 
trait StoreImageTrait {

    public function checkValidityAndStoreImage(Request $request, $inputname)
    {
        if($request->hasFile($inputname)){
 
            if(!$request->file($inputname)->isValid()){
 
                flash("Invalid Image!")->error()->important();
 
                return redirect()->back()->withInput();
            }
 
            $path = Storage::putFile("public/cfiles", $request->file($inputname));
            return $path;
        }
 
        return null;
    }

}