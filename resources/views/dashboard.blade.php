@include('nav')

<h3>Dashboard - User</h3>
<p>Hy {{ auth()->user()->name }}, Welcome to Dashboard</p>