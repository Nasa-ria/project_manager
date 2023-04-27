<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{



    public function index(){
        $projects = Project::orderBy('id','desc')->paginate(10);

      return view('project.index', compact('projects'));
    }

    
    public function create(){
        return view('project.form' );
    }

    public function store( Request $request){
        $data= $request->validate([
            'name'=>'required',
          
       
        ]);
        $project=Project::create($data);
        dd($project);
    }

    public function update(Request $request ,Project $project){
        $project= Project::findOrFail($project);

      $project->title = $request['title'];
      //Save/update task.
      $project->save();
    }

    public function destroy(string $project)
    {
        $deleted = Project::where('id', $project)->delete();
    }
}
