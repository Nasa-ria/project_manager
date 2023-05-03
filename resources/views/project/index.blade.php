@extends('layouts.index')
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <p class="btn_create"> <a class="a_create" href="/project/create">Create</a></p>
        @if(count($projects)>0)
        @foreach ($projects as $project)
        <!-- <div class="col-md-8 mb-4"> -->
        <button type="button" class="collapsible">{{$project->name}} <span class="action"><small><a href="{{ route('edit',$project->id) }}">Edit</a></small></span></button>
        <div class="content">
            @foreach ($project->sub_tasks as $sub_task)
            <ul>
                <div>
                    <p>{{ $sub_task->priority }}
                    <small> {{ $sub_task->title}}</small>:
                    <small> {{ $sub_task->note }}</small>
                    </p>  

</div>

<ul class="list">
    <li class="list-item" draggable="true"><a class="list-item-name">Favourite</a></li>
    <li class="list-item" draggable="true"><a class="list-item-name">Unique</a></li>
    <li class="list-item" draggable="true"><a class="list-item-name">Piano</a></li>
    <li class="list-item" draggable="true"><a class="list-item-name">Sleep</a></li>
    <li class="list-item" draggable="true"><a class="list-item-name">Practice</a></li>
  </ul>
            </ul>

            @endforeach
            <small><a href="{{ route('task.create')}}">create Task</a></small>


        </div>
        <br>
        @endforeach
        @else
        <p>No project </p>
        @endif
    </div>

</div>


<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;
    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>
@endsection