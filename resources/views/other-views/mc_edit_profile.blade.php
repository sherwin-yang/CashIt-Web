@extends('other-views/layout/template')

@section('editProfile')
    <div class="form">
        <form action="{{ route('editProfile') }}" method="POST">
            <div class="row">
                <div class="row">
                    <div class="col-6 ">
                        Nama Toko :
                    </div>
                    <div class="col-6">
                        <input type="text" name="name" value="{{ session()->get('user.moneyChangerName') }}" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Alamat :
                    </div>
                    <div class="col-6">
                        <input type="text" name="address" value="{{ session()->get('user.address') }}" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Nomor WhatsApp :
                    </div>
                    <div class="col-6">
                        <input type="text" name="WANumber" value="{{ session()->get('user.whatsAppNumber') }}" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Nomor Telepon (Kantor) :
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
                                <div class="col-3 day"> {{ $officeHour->day }}</div>
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
