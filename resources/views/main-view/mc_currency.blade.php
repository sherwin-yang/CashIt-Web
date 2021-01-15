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
                    @foreach ($currencyIndex ?? ['nil','nil'] as $currencies )
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$currencies->name ?? 'nil'}}</td>
                        <td>{{$currencies->sellPrice ?? 'nil'}}</td>
                        <td>{{$currencies->buyPrice ?? 'nil'}}</td>
                        <td>
                                <button class="btn btn-outline-primary" onclick="update('{{$currencies->name}}','{{$currencies->sellPrice}}','{{$currencies->buyPrice}}','{{$currencies->id}}')" data-modal-target="#editCurrency">Ubah</button>
                        </td>
                    </tr>
                    @endforeach
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
            <form method="post" action="{{ route('currency.store')}}">
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
                <form action="{{ route('currency.update',$currencies->id) }}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="row d-flex justify-content-center">
                            <div class="col-4">
                                <span>Mata Uang</span>
                            </div>
                            <div class="col-7">
                                <input type="text" id="name" name="name" class="form-control" aria-describedby="passwordHelpInline" value={{$currencies->name ?? ''}}>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-4">
                                <span>Harga Jual(Rp.)</span>
                            </div>
                            <div class="col-7">
                                <input type="text" id="sellPrice" name="sellPrice" class="form-control" aria-describedby="passwordHelpInline" value={{$currencies->sellPrice ?? ''}}>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-4">
                                <span>Harga Beli(Rp.)</span>
                            </div>
                            <div class="col-7">
                                <input type="text" id ="buyPrice" name ="buyPrice" class="form-control" aria-describedby="passwordHelpInline" value={{$currencies->buyPrice ?? ''}}>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id ="modalId" name="modalId">
                    <div class="action-button">
                        <button close-button class="btn btn-outline-danger">Batal</button>
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </form>
        </div>
    </div>

    <div id="overlay"></div>

    <script>
        function update(v,x,y,z){
                document.getElementById("name").value = v;
                document.getElementById("sellPrice").value = x;
                document.getElementById("buyPrice").value = y;
                document.getElementById("modalId").value = z;
                return false;
            }
    </script>

@endsection

