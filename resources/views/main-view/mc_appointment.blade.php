@extends('main-view/layout/mc_main')

@section('title', 'Appointment')

@section('appointment')

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
                    @foreach ($appointments as $appointment)
                        <tr>
                            <th scope="row">{{ $appointment->orderNumber }}</th>
                            <td>{{ $appointment->userName }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>{{ $appointment->toExchangeAmount }}</td>
                            <td>
                                <button class="btn btn-danger" onclick="finishTransaction('{{ $appointment->id }}')"
                                    data-modal-target="#finishTransaction">Selesaikan</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </table>
    </div>

    {{-- Finish Appointment --}}
    <div class="myModal" id="finishTransaction">
        <div class="header d-flex flex-row-reverse bd-highlight">
            <button close-button class="close-button">&times;</button>
        </div>
        <form action="{{ route('finishAppointment') }}" method="POST">
            @csrf
            <div class="content d-flex justify-content-center">
                <p class="message">Apakah transaksi ini ingin diselesaikan?</p>
                <input type="hidden" id="appointmentId" name="appointmentId">
                <div class="action-button">
                    <button name="button" value="selesaikan" class="btn btn-danger">Selesaikan</button>
                    <button close-button class="btn btn-dark">Tidak, lanjutkan</button>
                </div>
            </div>
        </form>
    </div>

    <div id="overlay"></div>

@endsection
