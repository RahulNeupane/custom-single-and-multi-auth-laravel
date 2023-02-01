<a href="{{ route('home') }}">Home</a> -
@auth
    <a href="{{ route('dashboard') }}">Dashboard</a> -
    <a href="{{ route('logout') }}">Logout</a>
@else
    <a href="{{ route('login') }}">Login</a> -
    <a href="{{ route('registration') }}">Registration</a>
@endauth
