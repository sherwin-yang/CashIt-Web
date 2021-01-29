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
        <form action="{{ route('admin') }}">
            <button name="button" class="btn btn-primary">Kembali</button>
            <br>
            <br>
        </form>
        <div class="mc_detail">
            <div class="row">
                <div class="col-2">
                    <h5>Nama</h5>
                </div>
                <div class="col-2">
                    <p>{{ $moneyChanger->moneyChangerName }}</p>
                </div>
            </div>
            <hr class="solid">
            <div class="row">
                <div class="col-2">
                    <h5>Alamat</h5>
                </div>
                <div class="col-2">
                    <p>{{ $moneyChanger->address }}</p>
                </div>
            </div>
            <hr class="solid">
            <div class="row">
                <div class="col-2">
                    <h5>Nomor WhatsApp</h5>
                </div>
                <div class="col-2">
                    <p>{{ $moneyChanger->whatsAppNumber }}</p>
                </div>
            </div>
            <hr class="solid">
            <div class="row">
                <div class="col-2">
                    <h5>Nomor Telepon</h5>
                </div>
                <div class="col-2">
                    <p>{{ $moneyChanger->phoneNumber }}</p>
                </div>
            </div>
            <hr class="solid">
            <div class="row">
                <div class="col-2">
                    <h5>Jam Operasional</h5>
                </div>
                @foreach ($officeHours as $officeHour)
                    <div class="col">
                        <h5>{{ $officeHour->day }}</h5>
                        <p><span>Buka :</span> {{ $officeHour->openTime }}</p>
                        <p><span>Tutup :</span> {{ $officeHour->closeTime }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </header>
</body>

</html>
