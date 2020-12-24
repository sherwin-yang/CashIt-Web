<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>

    <header>
        <div class="float-end">
            <button type="button" class="btn btn-danger log-out">Log Out</button>
        </div>
        <div class="row">
            <div class="col-2 photo-status">
                <div class="photo"></div>
                <span class="status">Status</span>
            </div>
            <div class="col-7 info">
                <span class="fs-1">Money Changer Maju Roso</span>
                <span>Jl. Doang Jadian Kaga</span>
                <span>10:00 - 18:00</span>
            </div>
            <div class="col-3 info">
                <span>021-123455</span>
                <span>0853123123123</span>
            </div>
        </div>
    </header>
        
    <div class="main">
        <div class="navigation">
            <nav>
                <ul class="row">
                    <li class="col-6">
                        <a href="/currencies">
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
    
        @yield('appointments')
    </div>
    
</body>
</html>
