@extends('customer.layout')

@section('content')

<h1 class="page-title">
    Dashboard Customer
</h1>

<p class="subtitle">
    Selamat datang, {{ Auth::user()->name }}
</p>

<section class="stats">

    <div class="card">

        <div class="icon blue">
            <i class="fa-solid fa-car"></i>
        </div>

        <div>
            <span>Lihat Mobil</span>
            <h2>Tersedia</h2>
        </div>

    </div>

    <div class="card">

        <div class="icon green">
            <i class="fa-solid fa-calendar-check"></i>
        </div>

        <div>
            <span>Booking</span>
            <h2>Rental</h2>
        </div>

    </div>

</section>

<section class="table-card">

    <div class="card-header">
        <h3>Informasi Customer</h3>
    </div>

    <div style="padding:20px">

        <p>Selamat datang di sistem RentalPro.</p>

        <br>

        <p>Silakan melihat daftar mobil yang tersedia dan melakukan booking kendaraan.</p>

        <br>

        <p>
            Nama :
            <strong>{{ Auth::user()->name }}</strong>
        </p>

        <p>
            Email :
            <strong>{{ Auth::user()->email }}</strong>
        </p>

    </div>

</section>

@endsection