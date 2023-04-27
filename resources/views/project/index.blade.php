@extends('layouts.index')
@section("content")
<div class="container">

    <div class="row justify-content-center">
        <p class="btn_create"> <a class="a_create" href="/project/create">Create</a></p>
        <div class=" col-md mb-3">
            <button type="button" class="collapsible">project</button>
            <div class="content">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <ul>
                    <li>subtask</li>
                    <li>edit</li>
                    <li>delete</li>
                </ul>
            </div>
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