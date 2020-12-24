@extends('layout/mc_main')

@section('title', 'Appointment')

@section('appointments')

<div class="appointment">
    <button type="button" class="btn btn-primary">+ Add Currency</button>

    <table class="table table-striped table-hover">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Waktu</th>
                <th scope="col">Jumlah Penukaran</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
            </tbody>
          </table>
    </table>
</div>
    
@endsection
