@extends('welcome/layout/welcome')

@section('login')
    <!-- Login Page -->
    <div class="form">
        <form action="">
            <div class="row">
                <div class="row">
                    <div class="col-6">
                        <label> Email : </label>
                    </div>
                    <div class="col-6">
                        <input type="text" name="email" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label> Password : </label>
                    </div>
                    <div class="col-6">
                        <input type="password" name="password" required />
                    </div>
                </div>
            </div>
            <button class="customButton">SIGN IN</button>
        </form>
    </div>
@endsection
