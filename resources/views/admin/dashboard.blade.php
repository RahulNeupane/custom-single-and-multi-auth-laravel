@include('admin.nav')

<h3>Dashboard - Admin</h3>
<p>Hy {{ Auth::guard('admin')->user()->name }}, Welcome to Dashboard</p>