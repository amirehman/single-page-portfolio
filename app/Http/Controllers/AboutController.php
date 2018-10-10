<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\AboutResource;
use File;


class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::get()->first();
        return new AboutResource($about);
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
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            'bio' => 'required'
        ]);


        $about->name = $request->name;
        $about->email = $request->email;
        $about->bio = $request->bio;

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

            File::delete(public_path('images/'. $about->image));

            $about->image = $filename;
        }


        
        $about->save();

        return response('Bio Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
