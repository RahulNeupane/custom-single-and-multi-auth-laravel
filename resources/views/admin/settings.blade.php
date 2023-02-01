@include('admin.nav')

<h3>Settings</h3>
<p>Hy {{ Auth::guard('admin')->user()->name }}, Only admins can view this page</p>