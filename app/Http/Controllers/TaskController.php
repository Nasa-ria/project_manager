<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */

      public function index(){
        return view('task.view');
      }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
       return view('task.form',['projects'=>$projects]);
  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request ->all());
        $data= $request->validate([
            'title'=>'required',
            'note'=>'required', 
            'project_id'=>'required'      
        ]);
        $task=Task::create($data);
        return $task;
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            //Find the user object from model if it exists
            $task= Task::findOrFail($id);
            //Redirect to edit user form with the user info found above.
            return view('add',['task'=>$task]);
        }
        catch(ModelNotFoundException $err){
            //redirect to your error page
            return $err;
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $task)
    {
        try{
      $task= Task::findOrFail($task);

      $task->title = $request['title'];
      $task->note = $request['note'];
      $task->priority = $request['priority'];
      $task->duration = $request['duration'];
      //Save/update task.
      $task->save();
           //redirect to somewhere?
    }
    catch(ModelNotFoundException $err){
        //Show error page
        return $err;
    }  
      }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $task)
    {
        $deleted = Task::where('id', $task)->delete();
    }

   

}
