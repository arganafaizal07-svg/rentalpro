<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payments - RentalPro</title>

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

                <a href="{{ route('cars.index') }}">
                    <i class="fa-solid fa-car"></i>
                    Cars
                </a>

                <a href="{{ route('customers.index') }}">
                    <i class="fa-solid fa-users"></i>
                    Customers
                </a>

                <a href="{{ route('payments.index') }}" class="{{ request()->routeIs('payments') ? 'active' : 'active' }}">
                    <i class="fa-solid fa-credit-card"></i>
                    Payments
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
            <div class="page-header">

                <div>
                    <h1 class="page-title">Payments</h1>
                    <p class="subtitle">
                        Monitor all payment transactions
                    </p>
                </div>

                <button class="add-btn">
                    <i class="fa-solid fa-file-export"></i>
                    Export Report
                </button>

            </div>

            <!-- PAYMENT STATS -->

            <div class="stats">

                <div class="card">

                    <div class="icon green">
                        <i class="fa-solid fa-wallet"></i>
                    </div>

                    <div>
                        <span>Total Revenue</span>
                        <h2>Rp 482M</h2>
                        <p>+18.5%</p>
                    </div>

                </div>

                <div class="card">

                    <div class="icon blue">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>

                    <div>
                        <span>Total Payments</span>
                        <h2>1,248</h2>
                        <p>+12.4%</p>
                    </div>

                </div>

                <div class="card">

                    <div class="icon orange">
                        <i class="fa-solid fa-clock"></i>
                    </div>

                    <div>
                        <span>Pending</span>
                        <h2>45</h2>
                        <p>Waiting</p>
                    </div>

                </div>

                <div class="card">

                    <div class="icon purple">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>

                    <div>
                        <span>Failed</span>
                        <h2>7</h2>
                        <p>Need Action</p>
                    </div>

                </div>

            </div>

            <!-- TABLE -->

            <div class="table-card">

                <div class="table-toolbar">

                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search invoice...">
                    </div>

                </div>

                <table>

                    <thead>

                        <tr>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Method</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td>INV-2025-001</td>
                            <td>John Doe</td>
                            <td>Credit Card</td>
                            <td>15 May 2025</td>
                            <td>Rp 2.500.000</td>
                            <td><span class="status success">Paid</span></td>
                            <td class="action-icons">
                                <i class="fa-regular fa-eye"></i>
                                <i class="fa-solid fa-download"></i>
                            </td>
                        </tr>

                        <tr>
                            <td>INV-2025-002</td>
                            <td>Sarah Johnson</td>
                            <td>Bank Transfer</td>
                            <td>17 May 2025</td>
                            <td>Rp 1.800.000</td>
                            <td><span class="status pending">Pending</span></td>
                            <td class="action-icons">
                                <i class="fa-regular fa-eye"></i>
                                <i class="fa-solid fa-download"></i>
                            </td>
                        </tr>

                        <tr>
                            <td>INV-2025-003</td>
                            <td>Michael Brown</td>
                            <td>QRIS</td>
                            <td>18 May 2025</td>
                            <td>Rp 4.200.000</td>
                            <td><span class="status success">Paid</span></td>
                            <td class="action-icons">
                                <i class="fa-regular fa-eye"></i>
                                <i class="fa-solid fa-download"></i>
                            </td>
                        </tr>

                        <tr>
                            <td>INV-2025-004</td>
                            <td>Emma Watson</td>
                            <td>E-Wallet</td>
                            <td>20 May 2025</td>
                            <td>Rp 1.500.000</td>
                            <td><span class="status failed">Failed</span></td>
                            <td class="action-icons">
                                <i class="fa-regular fa-eye"></i>
                                <i class="fa-solid fa-download"></i>
                            </td>
                        </tr>

                    </tbody>

                </table>

                <div class="pagination">

                    <button>‹</button>

                    <button class="active-page">1</button>

                    <button>2</button>

                    <button>3</button>

                    <button>›</button>

                </div>

            </div>

            <!-- PAYMENT METHODS -->

            <div class="form-card">

                <h3>Payment Methods Usage</h3>

                <div class="payment-methods">

                    <div class="method-item">
                        <i class="fa-solid fa-credit-card"></i>
                        <span>Credit Card</span>
                        <strong>42%</strong>
                    </div>

                    <div class="method-item">
                        <i class="fa-solid fa-building-columns"></i>
                        <span>Bank Transfer</span>
                        <strong>28%</strong>
                    </div>

                    <div class="method-item">
                        <i class="fa-solid fa-qrcode"></i>
                        <span>QRIS</span>
                        <strong>20%</strong>
                    </div>

                    <div class="method-item">
                        <i class="fa-solid fa-wallet"></i>
                        <span>E-Wallet</span>
                        <strong>10%</strong>
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