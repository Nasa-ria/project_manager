@extends('layouts.index')
@section("content")

<div class="container">
  <div class="row justify-content-center">
    <p class="heading_t mt-5">{{$project->name}} </p>
    <p class="btn_create"><a class="a_create" href="{{ route('task.create')}}">Add<i class="bi bi-plus-lg" style="font-size: 1em"></i></a></p>
    <p class="heading">Task(s)</p>
    <!-- (A) LOAD CSS + JS -->
    <script src="sort-list.js"></script>
    <!-- (B) THE LIST -->
    <ul id="task-list"  >
      @foreach ($sub_tasks as $sub_task)
      <li class="task" draggable="true" data-task-id="{{ $sub_task->priority }}" data-priority="{{ $sub_task->priority }}">
        <input type="checkbox" onchange="toggleTask(this)" >
        <span class="task-name">
            <strong>{{ $sub_task->priority }}. {{ $sub_task->title }}</strong><br>    
            <small>{{ $sub_task->note }}</small>
        </span>
        <span class="crud_task">
            <form action="{{ route('task-delete', $sub_task->id) }}" method="POST">
                @csrf
                @method('delete')
                <a class="a_link" href="{{ route('task-edit',$sub_task->id) }}"><i class="bi bi-files"></i></a>
                <button class="delete icon"><i class="bi bi-trash3"></i></button>
            </form>
        </span>
      
    </li>
      @endforeach
    </ul> 
    <!-- (C) CREATE SORTABLE LIST -->
     <script>
      slist(document.getElementById("task-list"));
    </script>

  </div>
</div>
@endsection






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- javaScript for drag and drop -->
<script>
  
    
        $(document).ready(function() {
            $('.task input[type="checkbox"]').on('change', function() {
                var taskElement = $(this).closest('.task');
                var taskName = taskElement.find('.task-name');
                var editLink = taskElement.find('.a_link');
                var deleteButton = taskElement.find('.delete');

                if ($(this).is(':checked')) {
                    taskName.addClass('completed');
                    disableCRUD(editLink, deleteButton);
                } else {
                    taskName.removeClass('completed');
                    enableCRUD(editLink, deleteButton);
                }
            });

            function disableCRUD(editLink, deleteButton) {
                editLink.addClass('disabled');
                editLink.removeAttr('href');
                deleteButton.prop('disabled', true);
            }

            function enableCRUD(editLink, deleteButton) {
                editLink.removeClass('disabled');
                var taskId = editLink.data('taskId');
                editLink.attr('href', '/task-edit/' + taskId);
                deleteButton.prop('disabled', false);
            }
        });


       
 


// Function to handle drag start event
function slist(target) {
  target.classList.add("slist");
  let items = target.getElementsByTagName("li"),
    current = null;

  for (let i of items) {
    i.draggable = true;

    i.ondragstart = e => {
      current = i;
      for (let it of items) {
        if (it != current) {
          it.classList.add("hint");
        }
      }
    };

    i.ondragenter = e => {
      if (i != current) {
        i.classList.add("active");
      }
    };

    i.ondragleave = () => i.classList.remove("active");

    i.ondragend = () => {
      for (let it of items) {
        it.classList.remove("hint");
        it.classList.remove("active");
      }
    };

    i.ondragover = e => e.preventDefault();

    i.ondrop = e => {
  e.preventDefault();
  if (i != current) {
    let currentPriority = current.dataset.priority;
    let droppedPriority = i.dataset.priority;
    let currentPos = 0;
    let droppedPos = 0;

    for (let it = 0; it < items.length; it++) {
      if (current == items[it]) {
        currentPos = it;
      }
      if (i == items[it]) {
        droppedPos = it;
      }
    }

    if (currentPos < droppedPos) {
      let up = i.parentNode.insertBefore(current, i.nextSibling);
      updatePrioritiesInBackend(up);

      // Update priorities for the remaining tasks
      for (let j = currentPos + 1; j <= droppedPos; j++) {
        let task = items[j];
        task.dataset.priority = parseInt(task.dataset.priority) - 1;
      }
    } else {
      i.parentNode.insertBefore(current, i);

      // Update priorities for the remaining tasks
      for (let j = droppedPos; j < currentPos; j++) {
        let task = items[j];
        task.dataset.priority = parseInt(task.dataset.priority) + 1;
      }
    }

    // Update the priorities in the backend
    updatePrioritiesInBackend();
  }
  };
  }
}

function updatePrioritiesInBackend() {
  // Retrieve all the tasks after reordering
  let tasks = document.querySelectorAll('.slist li');

  // Create an array to store the updated priorities
  let updatedPriorities = [];

  // Loop through the tasks and extract the updated priorities
  tasks.forEach(task => {
    let taskId = task.dataset.taskId;
    let priority = task.dataset.priority;
    updatedPriorities.push({ taskId, priority });
  });

  // Send an AJAX request to update the priorities in the backend
  fetch('/task/updatePriorities', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ priorities: updatedPriorities })
  })
  .then(response => {
    if (response.ok) {
      console.log('Priorities updated successfully.');
    } else {
      console.error('Failed to update priorities.');
    }
  })
  .catch(error => {
    console.error('An error occurred while updating priorities:', error);
  });
}


</script>

