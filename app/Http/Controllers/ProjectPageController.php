<?php

namespace App\Http\Controllers;

use App\ProjectPage;
use App\Project;
use Illuminate\Http\Request;
use File;
use ImageOptimizer;

class ProjectPageController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pid)
    {
        return response()->json([
            "pages" => ProjectPage::where('project_id', '=', $pid)->latest()->get()
        ]);
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
    public function store(Request $request, $pid)
    {

        $this->validate(request(), [
            'title' => 'required',
            'image' => 'required'
          ]);

        $slug = Project::find($pid)->slug;

        $filename = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];

        \Image::make($request->image)->save(public_path('images/').$filename);

        $page = new ProjectPage;
        $page->title = $request->title;
        $page->detail = $request->detail;
        $page->image = $filename;
        $page->project_id = $pid;
        if($page->save()){
            return $slug;
        }else{
            return "something wrong";
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectPage  $projectPage
     * @return \Illuminate\Http\Response
     */
    public function show($projectid, $pageid)
    {
        return  ProjectPage::find($pageid);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectPage  $projectPage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectPage $projectPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectPage  $projectPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $projectid, $pageid)
    {

        $this->validate(request(), [
            'title' => 'required'
          ]);

        $slug = Project::find($request->pid)->slug;
        
        $page = ProjectPage::find($pageid);

        if(strlen($request->image) > 220){
            
            
        
            $filename = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('images/').$filename);            

            File::delete(public_path('images/'. $page->image));

            $page->image = $filename;
        }
        
        $page->title = $request->title;
        $page->detail = $request->detail;
       
        $page->project_id = $request->pid;
        if($page->save()){
            return $slug;
        }else{
            return "something wrong";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectPage  $projectPage
     * @return \Illuminate\Http\Response
     */
    public function destroy($project, $pid)
    {
        $page = ProjectPage::where('id', '=', $pid)->first();
        File::delete(public_path('images/'. $page->image));
        $page->delete();
        
        return $page->project->slug;
        ;
    }

    public function updateAll (Request $request) {

        // $newProjects =  $request->project;
        // $projects = Project::all();
        // foreach ($projects as $project) {
        //     foreach ($newProjects as $newProject) {
        //         if($newProject['id']==$project->id){
        //               $project->update(['priority'=>$newProject['priority']]);
        //           }
        //     }
        // }

    }


}
