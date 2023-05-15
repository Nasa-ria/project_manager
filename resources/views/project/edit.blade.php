@extends('layouts.index')
@section("content")


<div class="container">     
    <form  class="mt-5" action="{{ route('update',$project->id) }}" method="post" >
         @csrf
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" value="{{$project->name}}" required>
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