<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="/js/api.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link rel="stylesheet" href="/css/home.css">
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js">
    </script>
</head>
<body>
    <div id="app">
    <nav>
      <div class="container">
        <div class="nav-wrapper">
          <a href="#" class="brand-logo">Fabric Otop</a>
          <ul class="hide-on-large-only">
            <li><a href="/">หน้าหลัก</a></li>
          </ul>
          <ul class="right">
            @if(Auth::guest())
            <li><a href="/login">ล็อกอิน</a></li>
            @else
            <li><a href="#">{{ Auth::user()->name }}</a></li>
            @endif
          </ul>
          <ul class="right hide-on-med-and-down">
            <li><a href="/">หน้าหลัก</a></li>
          </ul>
          
        </div>
      </div>
    </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    
    @yield('script')
</body>
</html>
