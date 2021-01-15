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

    <title>@yield('title')</title>
</head>

<body>
    <header>
        <form action="{{route('header')}}"method="GET">
            <div class="float-end">
                <a href="/logout">
                    <button type="button" class="btn btn-danger log-out">Keluar</button>
                </a>
            </div>
            <div class="row">
                <div class="col-2 photo-status">
                    <div class="photo"></div>
                    <span class="status">Status</span>
                </div>
                <div class="col-7 info">
                    <span class="fs-1">{{$MoneyChanger->name ?? 'Ganteng Doang'}}</span>
                    <span>{{$MoneyChanger->address ?? 'jalan mulu jadian kaga'}}</span>
                    <span>{{$officeHourList->openTime ?? 0}}-{{$officeHourList->closeTime ?? 0}}</span>
                </div>
                <div class="col-3 info">
                    <span>Telepon Rumah : {{$MoneyChanger->phoneNumber ?? '08213214245'}}</span>
                    <span>WhatsApp : {{$MoneyChanger->whatsAppLink ?? '08213214245'}}</span>
                </div>
            </div>
        </form>

    </header>

    <div class="main">
        <div class="navigation">
            <nav>
                <ul class="row">
                    <li class="col-6">
                        <a href="/currency">
                            <i class="far fa-money-bill-alt fa-2x"></i>
                            <span>Currencies</span>
                        </a>
                    </li>
                    <li class="col-6">
                        <a href="/appointment">
                            <i class="far fa-clock fa-2x"></i>
                            <span>Appointments</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        @yield('appointment')
        @yield('currency')
        @yield('welcome')
    </div>

</body>

</html>
