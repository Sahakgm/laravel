<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <link rel="stylesheet" href="{{ asset('css/_index.css') }}">
            @yield('css')
    </head>
<body>
    <nav class="navbar navbar-fixed-top">
        <span class="nav_style _home">
            <a href="{{ url('/') }}">Home</a>
        </span>
        <div class="container">
            <div class="navbar-header">
                <span class="nav_style">
                    <a href="{{ route('task.index') }}">Tasks</a>
                </span>
                <span class="nav_style">
                    <a href="{{ route('task.create') }}">New task</a>
                </span>
                <span class="_logout">
                    <ul>
                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                 </span>
            </div>
        </div>
    </nav>
    <div id="show-success"></div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            <h2>{{session('success')}}</h2>
        </div>
    @endif

@yield('content')

</body>
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
</script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn_delete').on('click', function () {
            $(".btn").css("pointer-events", "none");
        });
        $('.form-control').scrollTop(9999);
    </script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

@yield('script')

</html>
