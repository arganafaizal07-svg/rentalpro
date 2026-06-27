<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice Detail - RentalPro</title>

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

                <a href="dashboard.html">
                    <i class="fa-solid fa-table-columns"></i>
                    Dashboard
                </a>

                <a href="bookings.html" class="active">
                    <i class="fa-solid fa-calendar-check"></i>
                    Bookings
                </a>

            </nav>

        </aside>

        <main class="main">

            <div class="page-header">

                <div>

                    <h1 class="page-title">
                        Invoice Detail
                    </h1>

                    <p class="subtitle">
                        Invoice Number : INV-2025-001
                    </p>

                </div>

                <div>

                    <button class="edit-btn">
                        <i class="fa-solid fa-print"></i>
                        Print
                    </button>

                    <button class="save-btn">
                        <i class="fa-solid fa-download"></i>
                        Download PDF
                    </button>

                </div>

            </div>

            <!-- INVOICE -->

            <div class="invoice-card">

                <div class="invoice-top">

                    <div>

                        <h2>RentalPro</h2>

                        <p>
                            Jl. Sudirman No. 100<br>
                            Jakarta, Indonesia
                        </p>

                    </div>

                    <div class="invoice-status">

                        <span class="status success">
                            PAID
                        </span>

                    </div>

                </div>

                <hr>

                <div class="invoice-grid">

                    <div>

                        <h4>Billed To</h4>

                        <p>
                            John Doe<br>
                            john@email.com<br>
                            +62 812 3456 7890
                        </p>

                    </div>

                    <div>

                        <h4>Invoice Info</h4>

                        <p>
                            Invoice : INV-2025-001<br>
                            Date : 14 May 2025<br>
                            Due Date : 20 May 2025
                        </p>

                    </div>

                </div>

                <table>

                    <thead>

                        <tr>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td>Toyota Fortuner Rental</td>
                            <td>5 Days</td>
                            <td>Rp 1.200.000</td>
                            <td>Rp 6.000.000</td>
                        </tr>

                        <tr>
                            <td>Insurance Package</td>
                            <td>1</td>
                            <td>Rp 500.000</td>
                            <td>Rp 500.000</td>
                        </tr>

                        <tr>
                            <td>Tax</td>
                            <td>1</td>
                            <td>Rp 250.000</td>
                            <td>Rp 250.000</td>
                        </tr>

                    </tbody>

                </table>

                <div class="invoice-total">

                    <div class="invoice-summary">

                        <div>
                            <span>Subtotal</span>
                            <strong>Rp 6.500.000</strong>
                        </div>

                        <div>
                            <span>Tax</span>
                            <strong>Rp 250.000</strong>
                        </div>

                        <div class="grand-total">
                            <span>Total</span>
                            <strong>Rp 6.750.000</strong>
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