@extends('customer.layout')

@section('content')

<h1 class="page-title">
    Daftar Mobil
</h1>

<p class="subtitle">
    Mobil yang tersedia untuk disewa
</p>

<section class="table-card">

    <div class="card-header">
        <h3>Daftar Mobil</h3>
    </div>

    <table>

        <thead>
            <tr>
                <th>Nama Mobil</th>
                <th>Brand</th>
                <th>Harga/Hari</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @foreach($cars as $car)

            <tr>
                <td>{{ $car->name }}</td>
                <td>{{ $car->brand }}</td>
                <td>Rp {{ number_format($car->price_per_day,0,',','.') }}</td>
                <td>{{ $car->status }}</td>
                <td>
                    <a href="{{ route('customer.booking.create',$car) }}" class="btn-booking">Booking</a>
                </td>
            </tr> 

        @endforeach

        </tbody>

    </table>

</section>

@endsection