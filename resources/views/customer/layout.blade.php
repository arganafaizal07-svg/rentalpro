<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentalPro Customer Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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

            <a href="{{ route('customer.dashboard') }}" class="active">
                <i class="fa-solid fa-table-columns"></i>
                Dashboard
            </a>

            <a href="{{ route('customer.cars') }}">
                <i class="fa-solid fa-car"></i>
                Daftar Mobil
            </a>

            <a href="{{ route('customer.bookings') }}">
                <i class="fa-solid fa-calendar-check"></i>
                Booking Saya
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

    <div class="topbar"></div>

    @yield('content')

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