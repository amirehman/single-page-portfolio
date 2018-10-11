<?php

namespace App\Http\Controllers;

use App\About;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;


class MixController extends Controller
{
    
    public function contact(Request $request)
    {

        // Mail::to("hi@amirrehman.com")->send(new Contact($request));  
        Mail::to("askamirrehman@gmail.com")->send(new ContactEmail($request));  

    }

    
}
