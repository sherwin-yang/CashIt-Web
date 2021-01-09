@extends('other-views/layout/template')

@section('welcome')
    <!-- Welcome Page -->
    <div class="welcome">
        <h1>Cash It!</h1>
        <div>
            <a href="/login">
                <button href="/login" class="customButton">MASUK</button>
            </a>
        </div>
        <div>
            <a href="/register">
                <button class="customButton">DAFTARKAN</button>
            </a>
        </div>
    </div>
@endsection
