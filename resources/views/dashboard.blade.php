<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentalPro Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : 'active' }}">
                    <i class="fa-solid fa-table-columns"></i>
                    Dashboard
                </a>

                <a href="{{ route('bookings.index') }}">
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

<main class="main">
    
<button id="menu-toggle" class="menu-toggle">
    <i class="fa-solid fa-bars"></i>
</button>
    <!-- TOPBAR -->
    <div class="topbar"></div>



            <h1 class="page-title">Dashboard</h1>

            <p class="subtitle">
                Welcome back, Here's what's happening today.
            </p>

            <!-- STATISTICS -->
            <section class="stats">

                <div class="card">

                    <div class="icon orange">
                        <i class="fa-regular fa-calendar"></i>
                    </div>

                    <div>
                       <span>Total Bookings</span>
                        <h2>{{ $totalBookings }}</h2>
                    
                    </div>

                </div>

                <div class="card">

                    <div class="icon green">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>

                    <div>
                        <span>Total Revenue</span>
                       <h2>
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                       </h2>
                    
                    </div>

                </div>

                <div class="card">

                    <div class="icon blue">
                        <i class="fa-solid fa-car"></i>
                    </div>

                    <div>
                        <span>Total Cars</span>
                        <h2>{{ $totalCars }}</h2>
               
                    </div>

                </div>

                <div class="card">

                    <div class="icon purple">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <div>
                        <span>Total Customers</span>
                        <h2>{{ $totalCustomers }}</h2>
        
                    </div>

                </div>

            </section>

            <!-- CHART -->
            <section class="chart-card">

                <div class="card-header">
                    <h3>Revenue Overview</h3>
                </div>

                <canvas id="revenueChart"></canvas>

            </section>

            <!-- BOOKINGS -->
            <section class="table-card">

                <div class="card-header">
                    <h3>Recent Bookings</h3>
                </div>

                <table>

                    <thead>

                        <tr>
                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Car</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                        <tbody>

                        @forelse($recentBookings as $booking)

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
                                Rp {{ number_format($booking->total, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $booking->status }}
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6">
                                No bookings found
                            </td>
                        </tr>

                        @endforelse

</tbody>

                </table>

            </section>

        </main>

    </div>

<script>

const chartLabels = [
    @foreach($revenueChart as $item)
        '{{ date("F", mktime(0,0,0,$item->month,1)) }}',
    @endforeach
];

const chartRevenue = [
    @foreach($revenueChart as $item)
        {{ $item->revenue }},
    @endforeach
];

const ctx = document.getElementById('revenueChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartLabels,
        datasets: [{
            label: 'Revenue',
            data: chartRevenue,
            borderColor: '#ff6b00',
            backgroundColor: 'rgba(255,107,0,0.15)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,

        plugins: {
            legend: {
                display: false
            },

            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'Rp ' +
                            context.parsed.y
                            .toLocaleString('id-ID');
                    }
                }
            }
        },

        scales: {
            y: {
                ticks: {
                    callback: function(value) {
                        return 'Rp ' +
                            value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});



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
