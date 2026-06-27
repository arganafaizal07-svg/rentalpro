@extends('customer.layout')

@section('content')

<h1 class="page-title">
    Booking Mobil
</h1>

<p class="subtitle">
    Lengkapi data booking
</p>

<section class="table-card">

    <div style="padding:20px">

        <form method="POST" action="{{ route('customer.booking.store') }}">

            @csrf

            <input
                type="hidden"
                name="car_id"
                value="{{ $car->id }}"
            >

            <input
                type="hidden"
                name="customer_id"
                value="{{ auth()->id() }}"
            >

            <div style="margin-bottom:15px">

                <label>Mobil</label>

                <input
                    type="text"
                    value="{{ $car->name }}"
                    readonly
                >

            </div>

            <div style="margin-bottom:15px">

                <label>Tanggal Ambil</label>

                <input
                    type="date"
                    name="pickup_date"
                    required
                >

            </div>

            <div style="margin-bottom:15px">

                <label>Tanggal Kembali</label>

                <input
                    type="date"
                    name="return_date"
                    required
                >

            </div>

            <div style="margin-bottom:15px">

                <label>Catatan</label>

                <textarea
                    name="notes"
                    rows="3"
                ></textarea>

            </div>

            <input
                type="hidden"
                name="duration"
                value="1"
            >

            <input
                type="hidden"
                name="total"
                value="{{ $car->price_per_day }}"
            >

            <input
                type="hidden"
                name="status"
                value="Pending"
            >

            <button
                type="submit"
                class="logout-btn">

                Booking Sekarang

            </button>

        </form>

    </div>

</section>

@endsection