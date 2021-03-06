<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Lemon') }}</title>
    <!-- Styles -->
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset(elixir('/css/app.css'))}}" rel="stylesheet">
    @yield('styles')
    @yield('style')
            <!-- Scripts -->
    <script>
        window.Lemon = {!! json_encode([
            'csrfToken' => csrf_token(),
            'url' => url('/')
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Lemon') }}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if(Auth::check())
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                Permissions <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{route('users.index')}}">User</a>
                                </li>
                                <li>
                                    <a href="{{route('roles.index')}}">Role</a>
                                </li>
                                <li>
                                    <a href="{{url('permission/manage')}}">Manage Permission</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('posts.index')}}">Posts</a>
                        </li>
                        <li>
                            <a href="#">Media</a>
                        </li>
                        <li>
                            <a href="{{route('messages.index')}}">Messages</a>
                        </li>
                    </ul>
                    @endif
                            <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li>
                                <a href="#" class="notify">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="badge badge-notify" >3</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{route('profiles.index')}}">My Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</div>
<script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/pusher/pusher.js')}}"></script>
@yield('scripts')
        <!-- Scripts -->
<script src="{{asset(elixir('/js/app.js'))}}"></script>
<script src="{{asset(elixir('/js/helper.js'))}}"></script>

<script>
    (function() {
        @if(Auth::check())

        Pusher.logToConsole = true;

        var socket = new Pusher('{{env('PUSHER_KEY')}}', {
            authEndpoint: "{{ url('/broadcasting/auth') }}",
            //authEndpoint: "{{ url('/socket/auth') }}",
            auth: {
                headers: {
                    "X-CSRF-Token": "{{csrf_token()}}"
                }
            },
            cluster: 'ap1',
            encrypted: true
        });

        var channel = socket.subscribe('private-user.{{ Auth::user()->username }}');

        channel.bind('status.new', function(data) {
//            alert('horeee');
            console.log(data);
            var currentVal = parseInt($('.badge-notify').html());
            $('.badge-notify').html(currentVal + 1);
        });
        @endif
    })();
</script>

@yield('script')
</body>
</html>
