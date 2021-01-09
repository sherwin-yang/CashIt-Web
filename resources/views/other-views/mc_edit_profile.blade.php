@extends('other-views/layout/template')

@section('editProfile')
    <div class="form">
        <form action="">
            <div class="row">
                <div class="row">
                    <div class="col-6 ">
                        Nama Toko :
                    </div>
                    <div class="col-6">
                        <input type="text" name="name" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Alamat :
                    </div>
                    <div class="col-6">
                        <input type="text" name="address" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Nomor WhatsApp :
                    </div>
                    <div class="col-6">
                        <input type="text" name="WANumber" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Nomor Telepon (Kantor) :
                    </div>
                    <div class="col-6">
                        <input type="text" name="phoneNumber" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Logo atau Gambar Toko :
                    </div>
                    <div class="col-6">
                        <input type="file" name="myImage" accept="image/*" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Jam Operasional :
                    </div>
                    <div class="col-6 operational">
                        <div class="row">
                            <div class="col-3 day">Senin</div>
                            <div class="col-4">
                                <input type="text" name="seninOpen" placeholder="Jam Buka" required />
                            </div>
                            <div class="col-1">-</div>
                            <div class="col-4">
                                <input type="text" name="seninClose" placeholder="Jam Tutup" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 day">Selasa</div>
                            <div class="col-4">
                                <input type="text" name="selasaOpen" placeholder="Jam Buka" required />
                            </div>
                            <div class="col-1">-</div>
                            <div class="col-4">
                                <input type="text" name="selasaClose" placeholder="Jam Tutup" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 day">Rabu</div>
                            <div class="col-4">
                                <input type="text" name="rabuOpen" placeholder="Jam Buka" required />
                            </div>
                            <div class="col-1">-</div>
                            <div class="col-4">
                                <input type="text" name="rabuClose" placeholder="Jam Tutup" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 day">Kamis</div>
                            <div class="col-4">
                                <input type="text" name="kamisOpen" placeholder="Jam Buka" required />
                            </div>
                            <div class="col-1">-</div>
                            <div class="col-4">
                                <input type="text" name="kamisClose" placeholder="Jam Tutup" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 day">Jumat</div>
                            <div class="col-4">
                                <input type="text" name="jumatOpen" placeholder="Jam Buka" required />
                            </div>
                            <div class="col-1">-</div>
                            <div class="col-4">
                                <input type="text" name="jumatClose" placeholder="Jam Tutup" required />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button type="submit" class="submitbtn">UBAH</button>
                <button type="cancel" class="cancelbtn">BATALKAN</button>
            </div>
        </form>
    </div>
@endsection

{{--
<form class="editform" action="">
    <label> Money Changer Name :<input type="text" name="nama" required /> </label>
    <label> Address :<input type="text" name="alamat" required /> </label>
    <label> No.Telp (WhatsApp) :<input type="text" name="noTelpWA" required /> </label>
    <label> No.Telp (Office) :<input type="text" name="noTelpKantor" required /> </label>

    <label> Operasional Hour : Monday <input type="hour" name="jamBuka" placeholder="Jam Buka" required /> - <input
            type="hour" name="jamTututp" placeholder="Jam Tutup" required /> </label>
    <label> Tuesday <input type="hour" name="jamBuka" placeholder="Jam Buka" required /> - <input type="hour"
            name="jamTututp" placeholder="Jam Tutup" required /> </label>
    <label> Wednesday <input type="hour" name="jamBuka" placeholder="Jam Buka" required /> - <input type="hour"
            name="jamTututp" placeholder="Jam Tutup" /> </label>
    <label> Thursday <input type="hour" name="jamBuka" placeholder="Jam Buka" required /> - <input type="hour"
            name="jamTututp" placeholder="Jam Tutup" required /> </label>
    <label> Friday <input type="hour" name="jamBuka" placeholder="Jam Buka" required /> - <input type="hour"
            name="jamTututp" placeholder="Jam Tutup" required /> </label>
    <label> Saturday <input type="hour" name="jamBuka" placeholder="Jam Buka" required /> - <input type="hour"
            name="jamTututp" placeholder="Jam Tutup" required /> </label>
    <label> Sunday <input type="hour" name="jamBuka" placeholder="Jam Buka" required /> - <input type="hour"
            name="jamTututp" placeholder="Jam Tutup" required /> </label>
    <div>

    </div>
</form>
--}}
