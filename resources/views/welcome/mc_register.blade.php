@extends('welcome/layout/welcome')

@section('register')
    <!-- Register Page -->
    <div class="editform">
        <label>
            Money Changer Name :<input type="text" name="nama" required/> 
        </label>
        <label>
            Address :<input type="text" name="alamat" required/> 
        </label>
        <label> 
            Telephone Number (WhatsApp) :<input type="text" name="noTelpWA" required/> 
        </label>
        <label> Telephone Number (Office) :<input type="text" name="noTelpKantor" required/> </label>
        <label> Office Hour :<input type="hour" name="jamBuka" placeholder="Jam Buka"/>  - <input type="hour" name="jamTututp" placeholder="Jam Tutup"/> </label>
        <label> Email :<input type="text" name="email" /> </label>
        <label> Password :<input type="password" name="password" /> </label>
        <label> Confirmation Password:<input type="password" name="confirmationPassword" /> </label>
    </div>
    <div>
        <a href="/appointment">
            <button class="registerbtn">SIGN UP</button>
        </a>
    </div>
    
@endsection