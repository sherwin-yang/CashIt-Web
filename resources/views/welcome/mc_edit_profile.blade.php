@extends('welcome/layout/welcome')

@section('editProfile')


<!-- Edit Profile Page -->
<div class="editform">
        <label> Money Changer Name :<input type="text" name="nama" required /> </label>
        <label> Address :<input type="text" name="alamat" required /> </label>
        <label> No.Telp (WhatsApp) :<input type="text" name="noTelpWA" required /> </label>
        <label> No.Telp (Office) :<input type="text" name="noTelpKantor" required /> </label>

        <label> Operasional Hour : Monday <input type="hour" name="jamBuka" placeholder="Jam Buka" required/>  - <input type="hour" name="jamTututp" placeholder="Jam Tutup" required/> </label>
        <label> Tuesday <input type="hour" name="jamBuka" placeholder="Jam Buka" required/>  - <input type="hour" name="jamTututp" placeholder="Jam Tutup" required/> </label>
        <label> Wednesday <input type="hour" name="jamBuka" placeholder="Jam Buka" required/>  - <input type="hour" name="jamTututp" placeholder="Jam Tutup"/> </label>
        <label> Thursday <input type="hour" name="jamBuka" placeholder="Jam Buka" required/>  - <input type="hour" name="jamTututp" placeholder="Jam Tutup" required/> </label>
        <label> Friday <input type="hour" name="jamBuka" placeholder="Jam Buka" required/>  - <input type="hour" name="jamTututp" placeholder="Jam Tutup" required/> </label>
        <label> Saturday <input type="hour" name="jamBuka" placeholder="Jam Buka" required/>  - <input type="hour" name="jamTututp" placeholder="Jam Tutup" required/> </label>
        <label> Sunday <input type="hour" name="jamBuka" placeholder="Jam Buka" required/>  - <input type="hour" name="jamTututp" placeholder="Jam Tutup" required/> </label>

        <div>
            <button type="submit" class="registerbtn">SUBMIT</button>
            <button type="cancel" class="cancelbtn">CANCEL</button>  
        </div>
    </div>

@endsection