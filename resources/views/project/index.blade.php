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
            <!-- @foreach ($project->sub_tasks as $sub_task)
            <ul>
                <li>
                    <p>{{ $sub_task->priority }}
                        <small> {{ $sub_task->title}}</small>:
                        <small> {{ $sub_task->note }}</small>
                    </p>

                </li> -->
            <!-- @endforeach -->
            <small><a href="{{ route('task.create')}}">create Task</a></small>


        </div>
    
 
        <br>
        @endforeach
        @else
        <p>No project </p>
        @endif
    </div>
    <div class="list-container">
  <div class="list-title-container is-expanded">
    <span class="list-title">Song lists</span>
    <div class="btn-group">
      <span class="add-btn"></span>
      <span class="expand-btn"></span>
    </div>
  </div>
  <ul class="list">
    <li class="list-item" draggable="true"><a class="list-item-name">Favourite</a></li>
    <li class="list-item" draggable="true"><a class="list-item-name">Unique</a></li>
    <li class="list-item" draggable="true"><a class="list-item-name">Piano</a></li>
    <li class="list-item" draggable="true"><a class="list-item-name">Sleep</a></li>
    <li class="list-item" draggable="true"><a class="list-item-name">Practice</a></li>
  </ul>
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





    // function to be able to drag and reoder the position of the subtask
    const listContainer = document.querySelector(".list-container");
const listTitleContainer = listContainer.querySelector(".list-title-container");
const addBtn = listTitleContainer.querySelector(".add-btn");
const list = listContainer.querySelector(".list");
let listItems = list.querySelectorAll(".list-item");

/* list title */
listTitleContainer.addEventListener("click", function(e) {
  if (e.target !== addBtn) {
    if (this.className === "list-title-container is-expanded") {
      this.className = "list-title-container is-folded";
      list.style.display = "none";
    } else {
      this.className = "list-title-container is-expanded";
      list.style.display = "block";
    }
  }
});

addBtn.addEventListener("click", function(e) {
  const listItem = document.createElement("li");
  listItem.className = "list-item";
  listItem.draggable = true;
  listItem.addEventListener("click", handleListItemClicked);

  const listItemName = document.createElement("a");
  listItemName.className = "list-item-name";
  listItemName.innerText = "untitled";

  listItem.appendChild(listItemName);
  list.appendChild(listItem);
  listItems = list.querySelectorAll(".list-item");
});

/* list item clicked */
listItems.forEach(item => item.addEventListener("click", handleListItemClicked));
function handleListItemClicked(e) {
  listItems.forEach(item => item.className = "list-item");
  this.className = "list-item active";
}

let draggedTarget;
let helper;
document.addEventListener("dragstart", function(e) {
  draggedTarget = e.target;
  draggedTarget.style.backgroundColor = "#444";
  
    draggedTarget = e.target;
  draggedTarget.style.backgroundColor = "#444";

  helper = document.createElement("div");
  helper.innerText = draggedTarget.querySelector(".list-item-name").innerText;
  helper.style.position = "absolute";
  helper.style.top = "-9999px";
  helper.style.padding = "4px 8px";
  helper.style.backgroundColor = "#000";
  helper.style.color = "#ddd";
  helper.style.fontSize = "13px";
  helper.style.fontFamily = "Consolas";
  document.querySelector("body").appendChild(helper);
  
  e.dataTransfer.setDragImage(helper, -20, -10);
});

document.addEventListener("dragenter", function(e) {
  if (e.target !== draggedTarget && e.target.classList[0] === "list-item") {
    const ep = e.target.previousElementSibling;
    const en = e.target.nextElementSibling;
    const dp = draggedTarget.previousElementSibling;
    const dn = draggedTarget.nextElementSibling;

    if (!ep && !dn) {
      list.removeChild(draggedTarget);
      e.target.insertAdjacentElement("beforebegin", draggedTarget);
    } else if (!en && !dp) {
      list.removeChild(draggedTarget);
      e.target.insertAdjacentElement("afterend", draggedTarget);
    } else if (ep && ep != draggedTarget) {
      list.removeChild(e.target);
      list.removeChild(draggedTarget);
      ep.insertAdjacentElement("afterend", draggedTarget);
      draggedTarget.insertAdjacentElement("afterend", e.target);
    } else if (!ep) {
      list.removeChild(e.target);
      list.removeChild(draggedTarget);
      dn.insertAdjacentElement("beforebegin", e.target);
      e.target.insertAdjacentElement("beforebegin", draggedTarget);
    } else if (en && en != draggedTarget) {
      list.removeChild(e.target);
      list.removeChild(draggedTarget);
      en.insertAdjacentElement("beforebegin", draggedTarget);
      draggedTarget.insertAdjacentElement("beforebegin", e.target);
    } else if (!en) {
      list.removeChild(e.target);
      dp.insertAdjacentElement("afterend", e.target);
    }
  } 
});

document.addEventListener("dragover", function(e) {
  e.preventDefault(); // why necessary ?
});

document.addEventListener("drop", function(e) {
  e.preventDefault();
  draggedTarget.style.backgroundColor = "";
  helper.parentNode.removeChild(helper);
}); 
</script>
@endsection