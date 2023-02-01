<h3>Admin Login</h3>

<form action="{{ route('admin_login_submit') }}" method="POST">
    @csrf
    <div>Email Address</div>
    <div><input type="text" name="email"></div>
    <div>Password</div>
    <div><input type="password" name="password"></div>
    <div>
        <br>
        <input type="submit" value="Login">
    </div>
</form>