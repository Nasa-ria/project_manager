@extends('layouts.index')
@section("content")

<div class="container">
  <div class="row justify-content-center">
    <p class="heading_t">{{$project->name}} </p>
    <p class="btn_create"><a class="a_create" href="{{ route('task.create')}}">Create Task</a></p>
    <p class="heading">Task(s)</p>
    <!-- (A) LOAD CSS + JS -->

   
    <script src="sort-list.js"></script>
    <!-- (B) THE LIST -->
   

    <ul id="sortlist"   >
      @foreach ($sub_tasks as $sub_task)
   
      <li  >   
         <input type="checkbox" class="cbox4 " value="fourth_checkbox">
        <label class="cbox4">
       
       {{ $sub_task->priority}} . {{ $sub_task->title }} : {{ $sub_task->note }}
       <p id="completedMessage" class="completed-text">Completed!</p> 
        <span class="crud_task">
          <a class=" a_link" href="{{ route('task-edit',$sub_task->id)}}">Edit </a>
          <form action="{{ route('task-delete',$sub_task->id) }}" method="POST">
            @csrf
            @method('delete')
            <button class="btn_delete">Remove</button>
          </form>
        </span>
      </label>
      </li>
 

      @endforeach
    </ul> 
   
 
    <!-- (C) CREATE SORTABLE LIST -->
     <script>
      slist(document.getElementById("sortlist"));
    </script>

  </div>
</div>






@endsection








<!-- javaScript for drag and drop -->
<script>
  function slist(target) {
    // (A) SET CSS + GET ALL LIST ITEMS
    target.classList.add("slist");
    let items = target.getElementsByTagName("li"),
      current = null;

    // (B) MAKE ITEMS DRAGGABLE + SORTABLE
    for (let i of items) {
      // (B1) ATTACH DRAGGABLE
      i.draggable = true;

      // (B2) DRAG START - YELLOW HIGHLIGHT DROPZONES
      i.ondragstart = e => {
        current = i;
        for (let it of items) {
          if (it != current) {
            it.classList.add("hint");
          }
        }
      };

      // (B3) DRAG ENTER - RED HIGHLIGHT DROPZONE
      i.ondragenter = e => {
        if (i != current) {
          i.classList.add("active");
        }
      };

      // (B4) DRAG LEAVE - REMOVE RED HIGHLIGHT
      i.ondragleave = () => i.classList.remove("active");

      // (B5) DRAG END - REMOVE ALL HIGHLIGHTS
      i.ondragend = () => {
        for (let it of items) {
          it.classList.remove("hint");
          it.classList.remove("active");
        }
      };

      // (B6) DRAG OVER - PREVENT THE DEFAULT "DROP", SO WE CAN DO OUR OWN
      i.ondragover = e => e.preventDefault();

      // (B7) ON DROP - DO SOMETHING
      i.ondrop = e => {
        e.preventDefault();
        if (i != current) {
          let currentpos = 0,
            droppedpos = 0;
          for (let it = 0; it < items.length; it++) {
            if (current == items[it]) {
              currentpos = it;
            }
            if (i == items[it]) {
              droppedpos = it;
            }
          }
          if (currentpos < droppedpos) {
            i.parentNode.insertBefore(current, i.nextSibling);
          } else {
            i.parentNode.insertBefore(current, i);
          }
        }
      };
    }
  }



  function toggleCompleted() {
            // toggleStrikethrough();
            toggleDisplay();
        }

        // function toggleStrikethrough() {
        //     var textElement = document.getElementById("myText");
        //     textElement.classList.toggle("completed");
        // }

        function toggleDisplay() {
            var completedMessage = document.getElementById("completedMessage");
            completedMessage.style.display = completedMessage.style.display === "none" ? "block" : "none";
        }
</script>