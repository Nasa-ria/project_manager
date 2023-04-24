<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
         try{
        return view('create');
    }
    catch(ModelNotFoundException $err){
        //redirect to your error page
        return  $err;
    }
    
          
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->validate([
            'title'=>'required',
            'note'=>'required',
            'priority'=>'required',
            'duration'=>'required',
       
        ]);
        $task=Task::create($data);
        dd($task);
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
    public function update(Request $request,  $id)
    {
        try{
      $task= Task::findOrFail($id);

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
    public function destroy(string $id)
    {
        $deleted = Task::where('id', $id)->delete();
    }
}
