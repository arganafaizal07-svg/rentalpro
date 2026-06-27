<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RentalPro - Bookings</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="container">

        <!-- SIDEBAR -->
        <aside class="sidebar hide">

            <div class="logo">
                <div class="logo-icon">
                    <i class="fa-solid fa-cube"></i>
                </div>
                <h2>RentalPro</h2>
            </div>

            <nav>

                <a href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-table-columns"></i>
                    Dashboard
                </a>

                <a href="{{ route('bookings.index') }}" class="{{ request()->routeIs('bookings.*') ? 'active' : '' }}"
                    <i class="fa-solid fa-calendar-check"></i>
                    Bookings
                </a>

                <a href="{{ route('cars.index') }}">
                    <i class="fa-solid fa-car"></i>
                    Cars
                </a>





                <a href="{{ route('reports.index') }}">
                    <i class="fa-solid fa-chart-line"></i>
                    Reports
                </a>

                <a href="{{ route('users.index') }}">
                    <i class="fa-solid fa-user"></i>
                    Users
                </a>



<form method="POST" action="{{ route('logout') }}" class="logout-form">
    @csrf

    <button type="submit" class="logout-btn">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </button>
</form>

            </nav>

        </aside>

        <!-- MAIN -->

        <main class="main">
<button id="menu-toggle" class="menu-toggle">
    <i class="fa-solid fa-bars"></i>
</button>
<div class="topbar">

    <form method="GET" action="{{ route('bookings.index') }}">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search Booking ID, Customer, Car..."
            >

        </div>

    </form>

</div>

            <h1 class="page-title">Bookings</h1>

            <p class="subtitle">
                Manage all car bookings and reservations
            </p>

            <!-- STATUS MENU -->

            <div class="stats">

    <div class="card">
        <div class="icon green">
            <i class="fa-solid fa-wallet"></i>
        </div>

        <div>
            <span>Total Revenue</span>
            <h2>
                Rp {{ number_format($totalRevenue,0,',','.') }}
            </h2>
        </div>
    </div>

    <div class="card">
        <div class="icon blue">
            <i class="fa-solid fa-money-bill-wave"></i>
        </div>

        <div>
            <span>Total Payments</span>
            <h2>{{ $totalBookings }}</h2>
        </div>
    </div>

    <div class="card">
        <div class="icon orange">
            <i class="fa-solid fa-clock"></i>
        </div>

        <div>
            <span>Pending</span>
            <h2>{{ $pendingPayments }}</h2>
        </div>
    </div>

    <div class="card">
        <div class="icon purple">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div>
            <span>Paid</span>
            <h2>{{ $paidBookings }}</h2>
        </div>
    </div>

</div>

<div class="booking-tabs">

    <a href="{{ route('bookings.index') }}"
       class="tab {{ !request('status') ? 'active' : '' }}">
        All Bookings
    </a>

    <a href="{{ route('bookings.index',['status'=>'Pending']) }}"
       class="tab {{ request('status')=='Pending' ? 'active' : '' }}">
        Pending
    </a>

    <a href="{{ route('bookings.index',['status'=>'Confirmed']) }}"
       class="tab {{ request('status')=='Confirmed' ? 'active' : '' }}">
        Confirmed
    </a>

    <a href="{{ route('bookings.index',['status'=>'Ongoing']) }}"
       class="tab {{ request('status')=='Ongoing' ? 'active' : '' }}">
        Ongoing
    </a>

    <a href="{{ route('bookings.index',['status'=>'Completed']) }}"
       class="tab {{ request('status')=='Completed' ? 'active' : '' }}">
        Completed
    </a>

    <a href="{{ route('bookings.index',['status'=>'Cancelled']) }}"
       class="tab {{ request('status')=='Cancelled' ? 'active' : '' }}">
        Cancelled
    </a>

</div>

            <!-- TABLE -->

            <div class="table-card">

                <table>

                    <thead>

                        <tr>
                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Car</th>
                            <th>Pick-up Date</th>
                            <th>Return Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                   <tbody>

@forelse($bookings as $booking)

<tr>

    <td>
        BKG-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}
    </td>

    <td>
        {{ $booking->customer->name ?? '-' }}
    </td>

    <td>
        {{ $booking->car->name ?? '-' }}
    </td>

    <td>
        {{ \Carbon\Carbon::parse($booking->pickup_date)->format('d M Y') }}
    </td>

    <td>
        {{ \Carbon\Carbon::parse($booking->return_date)->format('d M Y') }}
    </td>

    <td>
        Rp {{ number_format($booking->total, 0, ',', '.') }}
    </td>

<td>

    @if($booking->status == 'Confirmed')
        <span class="status confirmed">Confirmed</span>

    @elseif($booking->status == 'Pending')
        <span class="status pending">Pending</span>

    @elseif($booking->status == 'Ongoing')
        <span class="status ongoing">Ongoing</span>

    @elseif($booking->status == 'Completed')
        <span class="status completed">Completed</span>

    @elseif($booking->status == 'Cancelled')
        <span class="status cancelled">Cancelled</span>

    @else
        <span class="status">{{ $booking->status }}</span>
    @endif

</td>

    <td>

        <a href="{{ route('bookings.show', $booking->id) }}">
            <i class="fa-solid fa-eye"></i>
        </a>

        <a href="{{ route('bookings.edit', $booking->id) }}">
            <i class="fa-solid fa-pen"></i>
        </a>

        <form
            action="{{ route('bookings.destroy', $booking->id) }}"
            method="POST"
            style="display:inline;"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                style="background:none;border:none;color:white;cursor:pointer;"
            >
                <i class="fa-solid fa-trash"></i>
            </button>

        </form>

    </td>

</tr>

@empty

<tr>
    <td colspan="8" style="text-align:center;">
        Tidak ada data booking
    </td>
</tr>

@endforelse

</tbody>

                </table>

<div class="pagination">

    @if($bookings->onFirstPage())
        <span class="page-btn disabled">‹</span>
    @else
        <a href="{{ $bookings->previousPageUrl() }}" class="page-btn">
            ‹
        </a>
    @endif

    @for($i = 1; $i <= $bookings->lastPage(); $i++)

        <a href="{{ $bookings->url($i) }}"
           class="page-btn {{ $bookings->currentPage() == $i ? 'active-page' : '' }}">
            {{ $i }}
        </a>

    @endfor

    @if($bookings->hasMorePages())
        <a href="{{ $bookings->nextPageUrl() }}" class="page-btn">
            ›
        </a>
    @else
        <span class="page-btn disabled">›</span>
    @endif

</div>
            </div>

        </main>

    </div>
<script>

document.addEventListener('DOMContentLoaded', function(){

    const toggleBtn = document.getElementById('menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    toggleBtn.addEventListener('click', function(){

        sidebar.classList.toggle('hide');

    });

});

</script>
</body>

</html>