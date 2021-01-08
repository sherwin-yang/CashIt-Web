@extends('welcome/layout/welcome')

@section('welcome')
    <!-- Welcome Page -->
            <b>Cash It!</b>
            <div>
                <a href="/login">
                    <button href="/login" class="registerbtn">SIGN IN</button>
                </a>
            </div>
            
            <div>
                <a href="/register">
                    <button class="registerbtn">SIGN UP</button>
                </a>
            </div>
            

@endsection