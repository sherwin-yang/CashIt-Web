@extends('other-views/layout/template')

@section('login')
    <!-- Login Page -->
    {{-- <h1 class="register-login-title">Masuk</h1> --}}
    <div class="form">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="row">
                <div class="row">
                    <div class="col-6">
                        <label> Email : </label>
                    </div>
                    <div class="col-6">
                        <input type="email" name="email" required />
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
            <button class="customButton">MASUK KE AKUN ANDA</button>
        </form>
    </div>
@endsection
