<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{



    public function index(Request $request ){
        $projects = Project::orderBy('id','desc')->get();
        foreach ($projects as $project) {
            // $id = $project->id
       
       $sub_tasks = Task::where('project_id', '=', $project->id)->orderBy('priority','desc')->get();
           $project->sub_tasks = $sub_tasks;
        }
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
        return back();
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
