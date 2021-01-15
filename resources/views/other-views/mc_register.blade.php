@extends('other-views/layout/template')

@section('register')
    {{-- <h1 class="register-login-title">Daftar</h1> --}}
    <div class="form">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="row">
                <div class="row">
                    <div class="col-6 ">
                        Nama Toko :
                    </div>
                    <div class="col-6">
                        <input type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                            value="{{ old('name') }}" required />
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                Silahkan masukkan nama lebih dari 6 karakter
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Alamat Lengkap :
                    </div>
                    <div class="col-6">
                        <input type="text" class="{{ $errors->has('address') ? 'is-invalid' : '' }}" name="address"
                            value="{{ old('address') }}" required />
                        @if ($errors->has('address'))
                            <div class="invalid-feedback">
                                Silahkan masukkan alamat lebih dari 12 karakter
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Nomor WhatsApp :
                    </div>
                    <div class="col-6">
                        <input type="text" class="{{ $errors->has('whatsAppNumber') ? 'is-invalid' : '' }}"
                            name="whatsAppNumber" value="{{ old('whatsAppNumber') }}" required />
                        @if ($errors->has('whatsAppNumber'))
                            <div class="invalid-feedback">
                                Nomor WhatsApp harus numerik dengan jumlah karakter minimal 10 dan maksimal 13
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Nomor Telepon (Kantor) :
                    </div>
                    <div class="col-6">
                        <input type="text" class="{{ $errors->has('phoneNumber') ? 'is-invalid' : '' }}" name="phoneNumber"
                            value="{{ old('phoneNumber') }}" required />
                        @if ($errors->has('phoneNumber'))
                            <div class="invalid-feedback">
                                Nomor telepon harus numerik dengan jumlah karakter minimal 8 dan maksimal 10
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Logo atau Gambar Toko :
                    </div>
                    <div class="col-6">
                        <input type="file" name="photo" accept="image/*" />
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
                                <input type="text" name="seninOpen" value="{{ old('seninOpen') }}" placeholder="Jam Buka"
                                    required />
                            </div>
                            <div class="col-1">-</div>
                            <div class="col-4">
                                <input type="text" name="seninClose" value="{{ old('seninClose') }}" placeholder="Jam Tutup"
                                    required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 day">Selasa</div>
                            <div class="col-4">
                                <input type="text" name="selasaOpen" value="{{ old('selasaOpen') }}" placeholder="Jam Buka"
                                    required />
                            </div>
                            <div class="col-1">-</div>
                            <div class="col-4">
                                <input type="text" name="selasaClose" value="{{ old('selasaClose') }}"
                                    placeholder="Jam Tutup" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 day">Rabu</div>
                            <div class="col-4">
                                <input type="text" name="rabuOpen" value="{{ old('rabuOpen') }}" placeholder="Jam Buka"
                                    required />
                            </div>
                            <div class="col-1">-</div>
                            <div class="col-4">
                                <input type="text" name="rabuClose" value="{{ old('rabuClose') }}" placeholder="Jam Tutup"
                                    required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 day">Kamis</div>
                            <div class="col-4">
                                <input type="text" name="kamisOpen" value="{{ old('kamisOpen') }}" placeholder="Jam Buka"
                                    required />
                            </div>
                            <div class="col-1">-</div>
                            <div class="col-4">
                                <input type="text" name="kamisClose" value="{{ old('kamisClose') }}" placeholder="Jam Tutup"
                                    required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 day">Jumat</div>
                            <div class="col-4">
                                <input type="text" name="jumatOpen" value="{{ old('jumatOpen') }}" placeholder="Jam Buka"
                                    required />
                            </div>
                            <div class="col-1">-</div>
                            <div class="col-4">
                                <input type="text" name="jumatClose" value="{{ old('jumatClose') }}" placeholder="Jam Tutup"
                                    required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Email :
                    </div>
                    <div class="col-6">
                        <input type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"
                            value="{{ old('email') }}" />
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                Email telah digunakan
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Kata Sandi :
                    </div>
                    <div class="col-6">
                        <input type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" />
                    </div>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            Pastikan kata sandi yang dimasukkan sama
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-6">
                        Konfirmasi Kata Sandi :
                    </div>
                    <div class="col-6">
                        <input type="password" class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                            name="password_confirmation" />
                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">
                                Pastikan kata sandi yang dimasukkan sama
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <button class="customButton">DAFTAR AKUN BARU</button>
        </form>
    </div>
@endsection

<!-- Register Page -->
{{-- <form action="">
    <label>
        Money Changer Name :<input type="text" name="nama" required />
    </label>
    <label>
        Address :<input type="text" name="alamat" required />
    </label>
    <label>
        Telephone Number (WhatsApp) :<input type="text" name="noTelpWA" required />
    </label>
    <label> Telephone Number (Office) :<input type="text" name="noTelpKantor" required /> </label>
    <label> Office Hour :<input type="hour" name="jamBuka" placeholder="Jam Buka" /> - <input type="hour"
            name="jamTututp" placeholder="Jam Tutup" /> </label>
    <label> Email :<input type="text" name="email" /> </label>
    <label> Password :<input type="password" name="password" /> </label>
    <label> Confirmation Password:<input type="password" name="confirmationPassword" /> </label>
    <button class="registerbtn">SIGN UP</button>
</form> --}}
