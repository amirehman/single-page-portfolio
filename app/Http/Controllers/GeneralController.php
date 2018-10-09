<?php

namespace App\Http\Controllers;

use App\General;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\GeneralResource;
use File;

class GeneralController extends Controller
{

     


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $general = General::get()->first();
        return new GeneralResource($general);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function show(General $general)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function edit(General $general)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, General $general)
    {

        $this->validate(request(), [
            'intro' => 'required',
            'company_image' => 'required'
        ]);

        $general->intro = $request->intro;
        $general->facebook = $request->facebook;
        $general->twitter = $request->twitter;
        $general->github = $request->github;
        $general->instagram = $request->instagram;
        $general->stackoverflow = $request->stackoverflow;
        $general->linkedin = $request->linkedin;
        $general->company_image = $request->company_image;


        if(strlen($request->image) > 220){
            $exploded = explode(',', $request->image);
            $decoded = base64_decode($exploded[1]);
    
            if(str_contains($exploded[0], 'jpeg'))
                $extension = "jpg";
            else 
                $extension = "png";
    
            $filename = str_random().time().'.'.$extension;
            $path = public_path().'/images/'.$filename;  
            file_put_contents($path, $decoded);

            File::delete(public_path('images/'. $general->dp));

            $general->dp = $filename;
        }


        
        $general->save();

        return response('General Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function destroy(General $general)
    {
        //
    }
}
