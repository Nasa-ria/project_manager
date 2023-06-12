
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="/">Home</a>
  <form class="navbar-form navbar-left" action="{{ route('search') }}" method="GET">
  <div class="input-group">
    <input type="text" class="form-control"  name="search" placeholder="Search">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="bi bi-search"></i>
      </button>
    </div>
  </div>
</form>
</nav>
