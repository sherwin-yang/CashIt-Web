@extends('main-view/layout/mc_main')

@section('title', 'Welcome')

@section('welcome')
    <!-- Welcome Page -->
    <div class="form">
        <label type="a"> Hello There!</label>
            <button class="registerbtn">SIGN IN</button>
            <button class="registerbtn">SIGN UP</button>
    </div>

    <!-- Login Page -->
    <div class="form">
        <label> Email :<input type="text" name="email" required/> </label>
        <label> Password :<input type="password" name="password" required/> </label>
        <button type="submit" class="registerbtn">SIGN IN</button>
    </div>

    <!-- Register Page -->
    <div class="form">
        <label> Money Changer Name :<input type="text" name="nama" required/> </label>
        <label> Address :<input type="text" name="alamat" required/> </label>
        <label> Telephone Number (WhatsApp) :<input type="text" name="noTelpWA" required/> </label>
        <label> Telephone Number (Office) :<input type="text" name="noTelpKantor" required/> </label>
        <label> Office Hour :<input type="hour" name="jamBuka" placeholder="Jam Buka"/>  - <input type="hour" name="jamTututp" placeholder="Jam Tutup"/> </label>
        <label> Email :<input type="text" name="email" /> </label>
        <label> Password :<input type="password" name="password" /> </label>
        <label> Confirmation Password:<input type="password" name="confirmationPassword" /> </label>
        <button type="submit" class="registerbtn">SIGN UP</button>
    </div>
    

@endsection
