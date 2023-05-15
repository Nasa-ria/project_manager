@extends('layouts.index')
@section("content")

<div class="container">
  <div class="row justify-content-center">
    <h4 class="row justify-content-center mt-4">{{$project->name}} </h4>
    <p class="btn_create"><a class="a_create" href="{{ route('task.create')}}">Create Task</a></p>
    @foreach ($sub_tasks as $sub_task)
    <div class="project_list">
      {{ $sub_task->priority}} . {{ $sub_task->title }} : {{ $sub_task->note }}

      <div class="task_crud">
        <p><a class=" a_link" href="{{ route('task-edit',$sub_task->id)}}">Edit </a>
          <span>
            <form action="{{ route('task-delete',$sub_task->id) }}" method="POST">
              @csrf
              @method('delete')
              <button class="btn_delete">Remove</button>
            </form>
          </span>
        </p>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection