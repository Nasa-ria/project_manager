@extends('layouts.index')
@section("content")


<div class="container">
  <form class="mt-5" action="{{ route('task.store') }}" method="post" >
    @csrf 


    <label for="project_id">Project:</label>
    <select name="project_id" class="form-control custom-select">
      <option value="">Select project</option>
      @foreach($projects as $project)
      <!-- @dump($projects) -->

        <option value="{{ $project->id }}" selected >{{ $project->name }}</option>
      @endforeach
    </select>

    <br>
    <label for="title">Name:</label>
    <input type="text" class="form-control" name="title" placeholder="Task manager" required>

    <br>
    <div class="form-group">
      <label for="note">Brief Note</label>
      <textarea type="text" class="form-control w-100 h-6" name="note"  required></textarea>
    </div>

    <br>
    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
      <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </div>

  </form>


</div>

</div>
</div>
</div>


@endsection