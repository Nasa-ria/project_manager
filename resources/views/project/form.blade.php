@extends('layouts.index')
@section("content")


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 mb-4">
      <form class="mt-5">
        <div class="form-group">
        {{ csrf_field() }}
          <label for="exampleFormControlInput1">Name:</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Task manager">
        </div>
      <br>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Brief Note</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" ></textarea>
        </div>
      </form>
     
    </div>
  </div>
</div>


@endsection