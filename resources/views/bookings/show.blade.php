<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Booking Details - RentalPro</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

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

                <a href="{{ route('cars.index') }}" class="active">
                    <i class="fa-solid fa-car"></i>
                    Cars
                </a>

                <a href="{{ route('customers.index') }}">
                    <i class="fa-solid fa-users"></i>
                    Customers
                </a>

                <a href="/payments">
                    <i class="fa-solid fa-credit-card"></i>
                    Payments
                </a>

                <a href="/reports">
                    <i class="fa-solid fa-chart-line"></i>
                    Reports
                </a>

                <a href="/users">
                    <i class="fa-solid fa-user"></i>
                    Users
                </a>

                <a href="/roles">
                    <i class="fa-solid fa-shield-halved"></i>
                    Roles & Permissions
                </a>



            </nav>

        </aside>

        <main class="main">

            <div class="page-header">

                <div>

                    <h1 class="page-title">
                        Booking Details
                    </h1>

                    <p class="subtitle">
                        Booking ID : BKG-2025-001
                    </p>

                </div>

                <div>

                    <a href="invoice-detail.html" class="save-btn">
                        <i class="fa-solid fa-file-invoice"></i>
                        View Invoice
                    </a>

                </div>

            </div>

            <!-- STATUS -->

            <div class="booking-status-banner">

                <span class="status success">
                    Confirmed
                </span>

            </div>

            <!-- GRID -->

            <div class="booking-detail-grid">

                <!-- CUSTOMER -->

                <div class="form-card">

                    <h3>Customer Information</h3>

                    <div class="customer-profile">

                        <img src="https://i.pravatar.cc/100?img=10">

                        <div>

                            <h4>John Doe</h4>

                            <p>john@email.com</p>

                            <p>+62 812 3456 7890</p>

                        </div>

                    </div>

                </div>

                <!-- CAR -->

                <div class="form-card">

                    <h3>Vehicle Information</h3>

                    <div class="vehicle-box">

                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=600">

                        <div>

                            <h4>Toyota Fortuner</h4>

                            <p>SUV • Automatic • Diesel</p>

                            <p>Plate : B 1234 ABC</p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RENTAL INFO -->

            <div class="form-card">

                <h3>Rental Information</h3>

                <div class="detail-list">

                    <div class="detail-item">
                        <span>Pick-up Date</span>
                        <strong>15 May 2025</strong>
                    </div>

                    <div class="detail-item">
                        <span>Return Date</span>
                        <strong>20 May 2025</strong>
                    </div>

                    <div class="detail-item">
                        <span>Rental Duration</span>
                        <strong>5 Days</strong>
                    </div>

                    <div class="detail-item">
                        <span>Pick-up Location</span>
                        <strong>Jakarta Office</strong>
                    </div>

                    <div class="detail-item">
                        <span>Return Location</span>
                        <strong>Jakarta Office</strong>
                    </div>

                </div>

            </div>

            <!-- PAYMENT -->

            <div class="form-card">

                <h3>Payment Summary</h3>

                <div class="detail-list">

                    <div class="detail-item">
                        <span>Rental Fee</span>
                        <strong>Rp 6.000.000</strong>
                    </div>

                    <div class="detail-item">
                        <span>Insurance</span>
                        <strong>Rp 500.000</strong>
                    </div>

                    <div class="detail-item">
                        <span>Tax</span>
                        <strong>Rp 250.000</strong>
                    </div>

                    <div class="detail-item total-row">
                        <span>Total Payment</span>
                        <strong>Rp 6.750.000</strong>
                    </div>

                </div>

            </div>

            <!-- TIMELINE -->

            <div class="form-card">

                <h3>Booking Timeline</h3>

                <div class="timeline">

                    <div class="timeline-item">
                        <div class="dot"></div>
                        <div>
                            <h4>Booking Created</h4>
                            <p>14 May 2025 • 10:30 AM</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="dot"></div>
                        <div>
                            <h4>Payment Received</h4>
                            <p>14 May 2025 • 11:00 AM</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="dot"></div>
                        <div>
                            <h4>Booking Confirmed</h4>
                            <p>14 May 2025 • 11:15 AM</p>
                        </div>
                    </div>

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