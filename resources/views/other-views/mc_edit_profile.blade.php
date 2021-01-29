@extends('other-views/layout/template')

@section('editProfile')
    <div class="form">
        <form action="{{ route('editProfile') }}" method="POST">
            @csrf
            <div class="row">
                <div class="row">
                    <div class="col-6 ">
                        Nama Toko <span class="required-star">*</span> :
                        <span class="register-validation">(Minimal 6 karakter)</span>
                    </div>
                    <div class="col-6">
                        <input type="text" name="name" value="{{ session()->get('user.moneyChangerName') }}" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Alamat <span class="required-star">*</span> :
                        <span class="register-validation">(Minimal 12 karakter)</span>
                    </div>
                    <div class="col-6">
                        <input type="text" name="address" value="{{ session()->get('user.address') }}" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Nomor WhatsApp <span class="required-star">*</span> :
                        <span class="register-validation">(10-13 karakter)</span>
                    </div>
                    <div class="col-6">
                        <input type="text" name="whatsAppNumber" value="{{ session()->get('user.whatsAppNumber') }}"
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Nomor Telepon (Kantor) <span class="required-star">*</span> :
                        <span class="register-validation">(6-10 karakter)</span>
                    </div>
                    <div class="col-6">
                        <input type="text" name="phoneNumber" value="{{ session()->get('user.phoneNumber') }}" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Jam Operasional :
                    </div>
                    <div class="col-6 operational">
                        @foreach ($officeHours as $officeHour)
                            <div class="row">
                                <div class="col-3 day"> {{ $officeHour->day }} <span class="required-star">*</span> </div>
                                <input type="hidden" name="{{ $officeHour->day . 'Id' }}" value="{{ $officeHour->id }}"
                                    required />
                                <div class="col-4">
                                    <input type="text" name="{{ $officeHour->day . 'Open' }}" placeholder="Jam Buka"
                                        value="{{ $officeHour->openTime }}" required />
                                </div>
                                <div class="col-1">-</div>
                                <div class="col-4">
                                    <input type="text" name="{{ $officeHour->day . 'Close' }}" placeholder="Jam Tutup"
                                        value="{{ $officeHour->closeTime }}" required />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button type="submit" class="submitbtn" name="button" value="ubah">KIRIM</button>
                <button type="cancel" class="cancelbtn" name="button" value="batalkan">BATALKAN</button>
            </div>
        </form>
    </div>
@endsection
