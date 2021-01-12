@extends('main-view/layout/mc_main')

@section('title', 'Appointment')

@section('appointment')

    <h1>Hello, {{ session('user_id') }}</h1>

    <div class="appointment">
        <table class="table table-striped table-hover">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Kode Antrian</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Jumlah Penukaran</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>
                            <button class="btn btn-danger" data-modal-target="#finishTransaction">Selesaikan</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </table>
    </div>

    <div class="myModal" id="finishTransaction">
        <div class="header d-flex flex-row-reverse bd-highlight">
            <button close-button class="close-button">&times;</button>
        </div>
        <div class="content d-flex justify-content-center">
            <p class="message">Apakah transaksi ini ingin diselesaikan?</p>
            <div class="action-button">
                <button class="btn btn-danger">Selesaikan</button>
                <button close-button class="btn btn-dark">Tidak, lanjutkan</button>
            </div>
        </div>
    </div>

    <div id="overlay"></div>

@endsection
