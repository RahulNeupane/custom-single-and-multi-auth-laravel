@include('nav')

<h3>Settings</h3>
<p>Hy {{ auth()->user()->name }}, Only admins can view this page</p>