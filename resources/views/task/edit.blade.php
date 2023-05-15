@extends('layouts.index')
@section("content")


<div class="container">
  <form class="mt-5" action="{{ route('task-update',$task->id) }}" method="post" >
    @csrf 

    <br>
    <label for="title">Name:</label>
<input type="text" class="form-control" name="title" value="{{ $task->title}}" required>

    <br>
    <div class="form-group">
      <label for="note">Brief Note</label>
      <textarea type="text" class="form-control w-100 h-6" name="note" row='250'  required>{{ $task->note}}</textarea>
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