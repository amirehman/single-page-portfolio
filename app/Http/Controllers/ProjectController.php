<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ProjectResource;
use File;
use Image;

class ProjectController extends Controller
{


     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('JWT', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProjectResource::collection(Project::orderBy('priority', 'asc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(), [
            'title' => 'required',
            'date' => 'required',
            'detail' => 'required',
          ]);


        $slug = str_slug($request->title);

        $project = new Project();
        $projects = Project::where('slug', '=', $slug)->get();

        if($projects->count() == 0)
        {
          $project->slug = $slug;
        }else{
          $count = Project::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
          $slug = $project->slug = $count ? "{$slug}-{$count}" : $slug;
        }

        
        $filename = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];

        \Image::make($request->image)->resize(600,null)->save(public_path('images/').$filename);


        $project->title = $request->title;
        $project->datee = $request->date;
        $project->detail = $request->detail;
        $project->image = $filename;
        $project->link = $request->link;
        $project->likes = 0;
        $project->slug = $slug;
        $project->save();
 
        return response()->json(
            [
                "message" => Response::HTTP_CREATED,
                'slug' => $slug
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pid)
    {

        $this->validate(request(), [
            'title' => 'required',
            'date' => 'required',
            'detail' => 'required',
          ]);

        $project = Project::where('id', '=', $pid)->first();
            
        if(strlen($request->image) > 220){

                    
            $filename = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];

            \Image::make($request->image)->resize(600,null)->save(public_path('images/').$filename);

            File::delete(public_path('images/'. $project->image));

            $project->image = $filename;

        }

        $likes = $project->likes + 1;    

        $project->title = $request->title;
        $project->datee = $request->date;
        $project->detail = $request->detail;
        $project->link = $request->link;
        $project->likes = $likes;
        $project->save();
        $project->elements()->sync($request->elements);    
        return response()->json(
            [
                "message" => Response::HTTP_CREATED
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($pid)
    {
        $project = Project::where('id', '=', $pid)->first();
        File::delete(public_path('images/'. $project->image));
        $project->delete();
        return response('null', Response::HTTP_NO_CONTENT);
    }



    public function updateAll (Request $request) {

        $newProjects =  $request->project;
        $projects = Project::all();
        foreach ($projects as $project) {
            foreach ($newProjects as $newProject) {
                if($newProject['id']==$project->id){
                      $project->update(['priority'=>$newProject['priority']]);
                  }
            }
        }

    }



}
