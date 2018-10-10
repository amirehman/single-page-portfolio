<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use Image;


class MixController extends Controller
{
    
    public function addResume(Request $request, $about)
    {
        if($request->hasFile('resume')) {

            // $resume = $request->resume;

            // $resumename = date('mdYHis') . uniqid() . '.' . $resume->getClientOriginalExtension();
            // $location = public_path('/images/resume/' . $resumename);

            // file_put_contents($location, $resumename);

            // $about->resume = $resumename;
            // $about->save();

            return $about;
    

        }
    }

    
}
