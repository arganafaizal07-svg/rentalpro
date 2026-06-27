@extends('customer.layout')

@section('content')

<h1 class="page-title">
    Booking Saya
</h1>

<p class="subtitle">
    Riwayat booking kendaraan
</p>

<section class="table-card">

    <div class="card-header">
        <h3>Daftar Booking</h3>
    </div>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Mobil</th>
                <th>Tanggal Ambil</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

        @foreach($bookings as $booking)

            <tr>
                <td>BKG-{{ str_pad($booking->id,4,'0',STR_PAD_LEFT) }}</td>
                <td>{{ $booking->car->name ?? '-' }}</td>
                <td>{{ $booking->pickup_date }}</td>
                <td>Rp {{ number_format($booking->total,0,',','.') }}</td>
                <td>{{ $booking->status }}</td>
            </tr>

        @endforeach

        </tbody>

    </table>

</section>

@endsection