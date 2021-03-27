<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>{{config('app.name')}}</title>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
      aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/posts">List Posts</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="/about">About</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="/services">Services</a>
        </li>
      </ul>
    </div>
    <div class="d-inline">
      <ul class="navbar-nav mr-auto">
        @guest
        <li class="nav-item">
          <a class="btn btn-secondary" href="{{ route('register')}}">Register</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-secondary ml-2" href="{{ route('login')}}">Login</a>
        </li>
        @endguest

        @auth
          <li class="nav-item mr-3">
            <span class="nav-link text-white">{{auth()->user()->name}}</span>
          </li>
          <li class="nav-item">
            <a class="btn btn-secondary" href="{{ route('posts.create')}}">Create Post</a>
          </li>
          <li class="nav-item">
            <form id="logout" action="{{ route('logout')}}" method="post">
              @csrf
              <button type="submit" class="btn btn-secondary ml-2">Logout</button>
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </nav>
  <div class="container">
    @yield('content')
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
  </script>
  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $('#logout').on('submit', function (e) {
      e.preventDefault();
      if (confirm("Do you want to logout?")) {
        this.submit();
      }      
    });
    $('form.delete').on('submit', function (e) {
      e.preventDefault();
      if (confirm("Confirm Delete Post?")) {
        this.submit();
      }      
    });
    </script>
</body>

</html>