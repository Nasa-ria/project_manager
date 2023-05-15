@extends('layouts.index')
@section("content")

<div class="container">
  <div class="row justify-content-center">
    <p class="btn_create"> <a class="a_create" href="{{ route('create')}}">Create Project</a></p>
    <h4 class="row justify-content-center">PROJECTS </h4>
    @if(count($projects)>0)
    @foreach ($projects as $project)


    <div class="project_list"> <a class="a_link" href="{{ route('SingleProject',$project->id) }}">{{$project->name}} </a>
     <span class="crud">
        <small><a  class= " a_link" href="{{ route('edit',$project->id)}}">Edit </a>  </small>

        <form action="{{ route('delete',$project->id) }}" method="POST">
          @csrf
          @method('delete')
          <button  class="btn_delete">Remove</button>
        </form>
      
        
</span>
</div>

    @endforeach
    

  </div>



  @else
  <p>No project </p>
  @endif


</div>
</div>



@endsection