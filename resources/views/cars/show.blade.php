<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Car Details - RentalPro</title>

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

        <!-- MAIN -->

        <main class="main">

            <div class="page-header">

                <div>
                    <h1 class="page-title">Toyota Fortuner 2025</h1>
                    <p class="subtitle">
                        Vehicle Details & Information
                    </p>
                </div>

                <div>

                    <button class="edit-btn">
                        <i class="fa-solid fa-pen"></i>
                        Edit
                    </button>

                    <button class="delete-btn">
                        <i class="fa-solid fa-trash"></i>
                        Delete
                    </button>

                </div>

            </div>

            <!-- HERO -->

            <div class="car-hero">

                <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200">

            </div>

            <!-- GALLERY -->

            <div class="gallery">

                <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=400">

                <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=400">

                <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=400">

                <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?w=400">

            </div>

            <!-- INFO GRID -->

            <div class="details-grid">

                <div class="form-card">

                    <h3>Vehicle Information</h3>

                    <div class="info-row">
                        <span>Brand</span>
                        <strong>Toyota</strong>
                    </div>

                    <div class="info-row">
                        <span>Category</span>
                        <strong>SUV</strong>
                    </div>

                    <div class="info-row">
                        <span>Year</span>
                        <strong>2025</strong>
                    </div>

                    <div class="info-row">
                        <span>Transmission</span>
                        <strong>Automatic</strong>
                    </div>

                    <div class="info-row">
                        <span>Fuel Type</span>
                        <strong>Diesel</strong>
                    </div>

                    <div class="info-row">
                        <span>Seats</span>
                        <strong>7 Seats</strong>
                    </div>

                </div>

                <div class="form-card">

                    <h3>Pricing</h3>

                    <div class="price-box">

                        <h1>Rp 1.200.000</h1>

                        <p>Per Day</p>

                    </div>

                    <div class="car-status available">
                        Available
                    </div>

                </div>

            </div>

            <!-- FEATURES -->

            <div class="form-card">

                <h3>Features</h3>

                <div class="feature-grid">

                    <div class="feature-item">Air Conditioning</div>
                    <div class="feature-item">Bluetooth</div>
                    <div class="feature-item">GPS Navigation</div>
                    <div class="feature-item">Rear Camera</div>
                    <div class="feature-item">Leather Seats</div>
                    <div class="feature-item">USB Charger</div>
                    <div class="feature-item">Sunroof</div>
                    <div class="feature-item">Parking Sensor</div>

                </div>

            </div>

            <!-- BOOKING HISTORY -->

            <div class="table-card">

                <h3>Recent Booking History</h3>

                <table>

                    <thead>

                        <tr>
                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td>BKG-001</td>
                            <td>John Doe</td>
                            <td>12 May 2025</td>
                            <td>Rp 2.500.000</td>
                            <td><span class="status success">Completed</span></td>
                        </tr>

                        <tr>
                            <td>BKG-002</td>
                            <td>Jane Smith</td>
                            <td>15 May 2025</td>
                            <td>Rp 3.000.000</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>

                        <tr>
                            <td>BKG-003</td>
                            <td>Michael Brown</td>
                            <td>18 May 2025</td>
                            <td>Rp 1.500.000</td>
                            <td><span class="status success">Completed</span></td>
                        </tr>

                    </tbody>

                </table>

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