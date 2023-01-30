@include('nav')

<h3>Forget Password</h3>

<form action="{{ route('forgetPassword_submit') }}" method="POST">
    @csrf
    <div>Email Address</div>
    <div><input type="text" name="email"></div>
    <div>
        <br>
        <input type="submit" value="Submit">
        <br>
        <a href="{{ route('login') }}">Back to login</a>
    </div>
</form>