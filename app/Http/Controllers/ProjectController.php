<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Route;


class ProjectController extends Controller
{



    public function index(Request $request ){
        // $projects = Project::orderBy('id','desc')->get();
        $projects = Project::all();
    //     foreach ($projects as $project) {
    //         // $id = $project->id
       
    //    $sub_tasks = Task::where('project_id', '=', $project->id)->orderBy('priority','desc')->get();
    //        $project->sub_tasks = $sub_tasks;
    //     }
      return view('project.index', compact('projects'));
    }


    public function SingleProject(string $id){
        $project= Project::findorfail($id);
        $sub_tasks = Task::where('project_id', '=', $project->id)->orderBy('priority', 'desc')->get();
     
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
        return  redirect('/')->with ('message','your project has been created.');
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
     return  redirect('/')->with ('message','your project has been update successfully.');
    }


    public function search(Request $request, $term){

            dd($term);
            // $routeName = Route::current()->getName();
            dd($request->all());
            //get the request the user is passing
            $search = $request->input('search');

            $url = 
            //if you get the request, search in the model 
            $project = Project::where('name', 'ilike', "%" . $search . "%" ) ->get();
            if( $project->count() > 0){
                return  $project ;
            }else{
                return response()->json([
                    "message" => "No results found"
                ]);
            }
        }
    

    
    public function destroy(string $id)
    {
        // $deleted = Project::where('id', '=',$id);
         Project::destroy($id);
         return redirect()->back();
    }
}
