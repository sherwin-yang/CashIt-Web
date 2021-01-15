@extends('main-view/layout/mc_main')

@section('title', 'Currency')

@section('currency')

    <div class="currency">
        <button type="button" class="btn btn-primary" data-modal-target="#addCurrency">+ Add Currency</button>
        <table class="table table-striped table-hover">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Valute</th>
                        <th scope="col">Jual (Rp.)</th>
                        <th scope="col">Beli (Rp.)</th>
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
                            <button class="btn btn-outline-primary" data-modal-target="#editCurrency">Ubah</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </table>
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
                            <span>Mata Uang</span>
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
            <form action="">
                <div class="row">
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <span>Mata Uang</span>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control" aria-describedby="passwordHelpInline">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <span>Harga Jual(Rp.)</span>
                        </div>
                        <div class="col-7">
                            <input type="number" class="form-control" aria-describedby="passwordHelpInline">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <span>Harga Beli(Rp.)</span>
                        </div>
                        <div class="col-7">
                            <input type="number" class="form-control" aria-describedby="passwordHelpInline">
                        </div>
                    </div>
                </div>
                <div class="action-button">
                    <button class="btn btn-danger" name="button" value="hapus">Hapus</button>
                    <button class="btn btn-success" name="button" value="ubah">Ubah</button>
                </div>
            </form>
        </div>
    </div>

    <div id="overlay"></div>

@endsection
