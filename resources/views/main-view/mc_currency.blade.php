@extends('main-view/layout/mc_main')

@section('title', 'Currency')

@section('currency')

    <div class="currency">
        <button type="button" class="btn btn-primary" data-modal-target="#addCurrency">+ Tambahkan Valuta</button>
        @if (count($currencies) > 0)
            <table class="table table-striped table-hover">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Valuta</th>
                            <th scope="col">Jual (Rp.)</th>
                            <th scope="col">Beli (Rp.)</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($currencies as $currency)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $currency->currencyName }}</td>
                                <td>{{ $currency->sellPrice }}</td>
                                <td>{{ $currency->buyPrice }}</td>
                                <td>
                                    <button class="btn btn-outline-primary"
                                        onclick="updateCurrency('{{ $currency->currencyName }}','{{ $currency->sellPrice }}','{{ $currency->buyPrice }}','{{ $currency->id }}')"
                                        data-modal-target="#editCurrency">Ubah
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </table>
        @else
            <p class="no_data">Anda belum mendaftarkan valuta. Silahkan tambahkan valuta.</p>
        @endif

    </div>

    {{-- Add Currency --}}
    <div class="myModal" id="addCurrency">
        <div class="header d-flex flex-row-reverse bd-highlight">
            <button close-button class="close-button">&times;</button>
        </div>
        <div class="content d-flex justify-content-center">
            <form action="{{ route('addNewCurrency') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <span>Nama Valuta</span>
                        </div>
                        <div class="col-7">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <span>Harga Jual(Rp.)</span>
                        </div>
                        <div class="col-7">
                            <input type="text" name="buyPrice" class="form-control" required>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <span>Harga Beli(Rp.)</span>
                        </div>
                        <div class="col-7">
                            <input type="text" name="sellPrice" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="action-button">
                    <button close-button class="btn btn-outline-danger">Batal</button>
                    <button class="btn btn-success" name="button" value="tambahkan">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Currency --}}
    <div class="myModal" id="editCurrency">
        <div class="header d-flex flex-row-reverse bd-highlight">
            <button close-button class="close-button">&times;</button>
        </div>
        <div class="content d-flex justify-content-center">
            <form action="{{ route('editCurrency') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <span>Nama Valuta</span>
                        </div>
                        <div class="col-7">
                            <input type="text" id="name" name="name" class="form-control"
                                aria-describedby="passwordHelpInline">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <span>Harga Jual(Rp.)</span>
                        </div>
                        <div class="col-7">
                            <input type="text" id="sellPrice" name="sellPrice" class="form-control"
                                aria-describedby="passwordHelpInline">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <span>Harga Beli(Rp.)</span>
                        </div>
                        <div class="col-7">
                            <input type="text" id="buyPrice" name="buyPrice" class="form-control"
                                aria-describedby="passwordHelpInline">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="currencyId" name="currencyId">
                <div class="action-button">
                    <button name="button" value="hapus" class="btn btn-danger">Hapus</button>
                    <button name="button" value="ubah" class="btn btn-success">Ubah</button>
                </div>
            </form>
            </form>
        </div>
    </div>

    <div id="overlay"></div>
@endsection
