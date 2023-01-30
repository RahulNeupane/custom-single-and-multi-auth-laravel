@include('nav')

<h3>Login</h3>

<form action="" method="POST">
    <div>Email Address</div>
    <div><input type="text" name="email"></div>
    <div>Password</div>
    <div><input type="password" name="password"></div>
    <div>
        <br>
        <input type="submit" value="Login">
        <br>
        <a href="{{ route('forgetPassword') }}">Forget Password ?</a>
    </div>
</form>