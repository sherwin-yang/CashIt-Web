<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script defer src="{{ asset('/js/app.js') }}"></script>

    <title>Admin</title>
</head>

<body>
    <header>
        <div class="float-end">
            <a href="/logout">
                <button type="button" class="btn btn-danger log-out">Keluar</button>
            </a>
        </div>
        <h1>Hi Admin {{ session()->get('user.adminName') }} !</h1>
    </header>

    <div class="main">
        <table class="table table-striped table-hover">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nomor</th>
                        <th scope="col">MoneyChanger</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($moneyChangers as $moneyChanger)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $moneyChanger->moneyChangerName }}</td>
                            <td class="admin-action">
                                <button type="button" class="btn btn-success" data-modal-target="#approve"
                                    onclick="approveMC('{{ $moneyChanger->id }}')">Setujui</button>
                                <button type="button" class="btn btn-dark" data-modal-target="#giveRevision"
                                    onclick="giveRevise('{{ $moneyChanger->id }}')">Beri Revisi</button>
                                <form action="{{ route('view_mcDetail') }}" method="GET">
                                    <input type="hidden" name="moneyChangerId" value="{{ $moneyChanger->id }}">
                                    <button name="button" class="btn btn-outline-primary">Detail</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </table>
    </div>

    {{-- Approve Money Changer --}}
    <div class="myModal" id="approve">
        <div class="header d-flex flex-row-reverse bd-highlight">
            <button close-button class="close-button">&times;</button>
        </div>
        <form action="{{ route('approveMoneyChanger') }}" method="POST">
            @csrf
            <div class="content d-flex justify-content-center">
                <p class="message">Yakin memberikan persetujuan?</p>
                <input type="hidden" id="moneyChanger_id" name="moneyChangerId">
                <div class="row d-flex justify-content-center">
                    <div class="col-4 coordinate-span">
                        <span>Koordinat Latitude</span>
                    </div>
                    <div class="col-7">
                        <input type="text" name="latitudeCoordinate" class="form-control" required>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-4 coordinate-span">
                        <span>Koordinat Longitude</span>
                    </div>
                    <div class="col-7">
                        <input type="text" name="longitudeCoordinate" class="form-control" required>
                    </div>
                </div>
                <div class="action-button">
                    <button name="button" value="approve" class="btn btn-success">Setujui</button>
                    <button close-button class="btn btn-outline-danger">Batal</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Give Revision --}}
    <div class="myModal" id="giveRevision">
        <div class="header d-flex flex-row-reverse bd-highlight">
            <button close-button class="close-button">&times;</button>
        </div>
        <form action="{{ route('giveRevision') }}" method="POST">
            @csrf
            <div class="content d-flex justify-content-center">
                <input type="hidden" id="moneyChangerId" name="moneyChangerId">
                <textarea id="revisionNote" name="revisionNote" placeholder="Catatan Revisi" rows="3"></textarea>
                <div class="action-button">
                    <button name="button" value="approve" class="btn btn-success">Beri Revisi</button>
                </div>
            </div>
        </form>
    </div>

    <div id="overlay"></div>

</body>

</html>
