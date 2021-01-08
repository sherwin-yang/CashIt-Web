@extends('welcome/layout/welcome')

@section('login')
    <!-- Login Page -->
<div class="editform">
        <label> Email :<input type="text" name="email" required /> </label>
        <label> Password :<input type="password" name="password" required /> </label>
</div>
        <div>
                <a href="/appointment">
                    <button class="registerbtn">SIGN IN</button>
                </a>
        </div>
@endsection