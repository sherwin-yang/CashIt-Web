@extends('welcome/layout/welcome')

@section('welcome')
    <!-- Welcome Page -->
    <div class="welcome">
        <h1>Cash It!</h1>
        <div>
            <a href="/login">
                <button href="/login" class="customButton">SIGN IN</button>
            </a>
        </div>
        <div>
            <a href="/register">
                <button class="customButton">SIGN UP</button>
            </a>
        </div>
    </div>
@endsection
