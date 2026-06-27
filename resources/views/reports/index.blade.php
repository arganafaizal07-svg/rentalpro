<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reports - RentalPro</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <div class="container">

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

                <a href="{{ route('bookings.index') }}">
                    <i class="fa-solid fa-calendar-check"></i>
                    Bookings
                </a>

                <a href="{{ route('cars.index') }}">
                    <i class="fa-solid fa-car"></i>
                    Cars
                </a>





                <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports') ? 'active' : 'active' }}">
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
            <div class="page-header">

                <div>
                    <h1 class="page-title">Reports & Analytics</h1>
                    <p class="subtitle">
                        Business performance overview
                    </p>
                </div>



            </div>

            <!-- KPI -->

            <div class="stats">

                <div class="card">
                    <div class="icon orange">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
<span>Total Revenue</span>

<h2>
    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
</h2>

<p></p>
                </div>

                <div class="card">
                    <div class="icon green">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
<span>Total Bookings</span>

<h2>{{ $totalBookings }}</h2>

<p></p>
                </div>

                <div class="card">
                    <div class="icon blue">
                        <i class="fa-solid fa-users"></i>
                    </div>
<span>Total Customers</span>

<h2>{{ $newCustomers }}</h2>

<p></p>
                </div>

                <div class="card">
                    <div class="icon purple">
                        <i class="fa-solid fa-car"></i>
                    </div>
<span>Fleet Usage</span>

<h2>{{ $fleetUsage }}%</h2>

<p></p>
                </div>

            </div>

            <!-- CHARTS -->

            <div class="report-grid">

                <div class="chart-card">

                    <h3>Monthly Revenue</h3>

                    <canvas id="revenueChart"></canvas>

                </div>

                <div class="chart-card">

                    <h3>Booking Distribution</h3>

                    <canvas id="bookingChart"></canvas>

                </div>

            </div>

            <!-- TOP CARS -->

            <div class="table-card">

                <h3>Top Performing Cars</h3>

                <table>

                    <thead>

                        <tr>
                            <th>Car</th>
                            <th>Total Bookings</th>
                            <th>Revenue</th>
                           
                        </tr>

                    </thead>

                    <tbody>

@forelse($topCars as $car)

<tr>

    <td>{{ $car->name }}</td>

    <td>{{ $car->total_bookings }}</td>

    <td>
        Rp {{ number_format($car->revenue, 0, ',', '.') }}
    </td>

    

</tr>

@empty

<tr>

    <td colspan="4" style="text-align:center;">
        No data available
    </td>

</tr>

@endforelse

</tbody>

                </table>

            </div>

        </main>

    </div>

<script>

const revenueChart = document.getElementById('revenueChart');

new Chart(revenueChart, {
    type: 'line',
    data: {
        labels: [

            @foreach($monthlyRevenue as $item)
                '{{ date("M", mktime(0,0,0,$item->month,1)) }}',
            @endforeach

        ],
        datasets: [{
            label: 'Revenue',
            data: [

                @foreach($monthlyRevenue as $item)
                    {{ $item->revenue }},
                @endforeach

            ],
            borderColor: '#ff6b00',
            backgroundColor: 'rgba(255,107,0,0.2)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});


const bookingChart = document.getElementById('bookingChart');

new Chart(bookingChart, {
    type: 'doughnut',
    data: {
        labels: [

            @foreach($bookingDistribution as $item)
                '{{ ucfirst($item->status) }}',
            @endforeach

        ],
        datasets: [{
            data: [

                @foreach($bookingDistribution as $item)
                    {{ $item->total }},
                @endforeach

            ],
            backgroundColor: [
                '#ff6b00',
                '#3b82f6',
                '#22c55e',
                '#a855f7',
                '#ef4444',
                '#facc15'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    color: '#ffffff'
                }
            }
        }
    }
});


document.addEventListener('DOMContentLoaded', function () {

    const toggleBtn = document.getElementById('menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('hide');
    });

});

</script>

</body>

</html>