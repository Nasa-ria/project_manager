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


    public function SingleProject(string $id){
        $project= Project::findorfail($id);
        $sub_tasks = Task::where('project_id', '=', $project->id)->orderBy('priority', 'desc')->get();

        // $project->sub_tasks = $sub_tasks;
     
        return view('project.SingleProject', compact('project', 'sub_tasks'));

        
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

    public function edit(string $id)
    {
        
            //Find the user object from model if it exists
            $project= Project::findOrFail($id);
            //Redirect to edit user form with the user info found above.
            return view('project.edit',['project'=>$project]);
        
   
        
    }
    public function update(Request $request ,$id){
        $project= Project::findOrFail($id);

      $project->name = $request['name'];
      //Save/update task.
      $project->save();
      return back();
    }

    public function destroy(string $id)
    {
        $deleted = Project::where('id', '=',$id)->delete();
        return back();
    }
}
