<a href="{{ route('home') }}">Home</a> -
@auth
    @if (auth()->user()->role == 1)
        <a href="{{ route('dashboard_admin') }}">Dashboard</a> -
        <a href="{{ route('settings') }}">Settings</a> -
    @else
        <a href="{{ route('dashboard_user') }}">Dashboard</a> -
    @endif
    <a href="{{ route('logout') }}">Logout</a>
@else
    <a href="{{ route('login') }}">Login</a> -
    <a href="{{ route('registration') }}">Registration</a>
@endauth
