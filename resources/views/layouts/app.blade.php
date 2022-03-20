<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body class="bg-light">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Mo's Tech Blog
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="btn btn-outline-primary" href="{{ route('blog.create') }}" role="button">Create Blog</a>
                            </li>
                            <li class="nav-item dropdown ml-2">
                                @if (Auth::user()->notifications->count()>0)
                                    <a id="notiDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa-solid fa-bell"></i>@if (Auth::user()->unreadNotifications->count()>0)<span class="numberCircle text-white ml-2 small font-weight-bold">{{Auth::user()->unreadNotifications->count()}}</span>@endif
                                    <a/>
                                @else
                                    <a id="notiDropdown" class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa-solid fa-bell"></i>
                                    <a/>
                                @endif

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notiDropdown">
                                    @if (Auth::user()->notifications->count()>0) 
                                        @foreach(Auth::user()->notifications as $notification)
                                            <div class="dropdown-divider"></div>
                                            <a class="noti-div dropdown-item {{ $notification->read()? 'text-muted' : '' }}" href="{{$notification->data['offerUrl']}}" data-at="{{$notification->id}}"> 
                                                @if($notification->type == 'App\Notifications\CommentNotification')
                                                    <b>{{$notification->data['name']}}</b> commented on your blog <b>{{$notification->data['blogTitle']}}</b>.
                                                @else
                                                    <b>{{$notification->data['name']}}</b> liked your blog <b>{{$notification->data['blogTitle']}}</b>.
                                                @endif
                                                @if ($notification->unread())
                                                    <span class="blue-dot"></span>
                                                @endif
                                            </a>
                                        @endforeach                
                                    @endif
                                </div>
                            </li>

                            <li class="nav-item dropdown ml-1">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    <div class="dropdown-divider"></div>
                                    
                                    <a class="dropdown-item" href="{{ route('profile.view', Auth::user()->id) }}">Profile</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        $(document).ready(function () {
            $('.noti-div').click(function () {
                let id = $(this).attr('data-at');

                $.ajax({
                    type: "POST",
                    url: "{{route('comment.read')}}",
                    data: {'notiid': id},
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function() {
                        console.log('success');                
                    },
                    error: function() {
                        alert("failure From php side!!!");
                    }
                });
            });
        });
    </script>
</body>
</html>
