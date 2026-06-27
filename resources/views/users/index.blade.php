<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Users - RentalPro</title>

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
                <a href="/reports">
                    <i class="fa-solid fa-chart-line"></i>
                    Reports
                </a>
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users') ? 'active' : 'active' }}">
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
                    <h1 class="page-title">Users Management</h1>
                    <p class="subtitle">
                        Manage admin, manager and staff accounts
                    </p>
                </div>



            </div>

            <!-- USER STATS -->

            <div class="stats">

                <div class="card">
                    <div class="icon orange">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <span>Total Users</span>
                        <h2>{{ $totalUsers }}</h2>
                        <p>System Accounts</p>
                    </div>
                </div>

                <div class="card">
                    <div class="icon green">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <div>
                        <span>Active Users</span>
                        <h2>{{ $totalUsers }}</h2>
                        <p>Registered Accounts</p>
                    </div>
                </div>





            </div>

            <!-- USER TABLE -->

            <div class="table-card">

                <div class="table-toolbar">

                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search users...">
                    </div>

                </div>

                <table>

                    <thead>

                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                           
                        </tr>

                    </thead>

<tbody>

@forelse($users as $user)

<tr>

    <td>

        <div class="customer-info">

            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ff6b00&color=fff">

            <div>
                <h4>{{ $user->name }}</h4>
                <small>
                    USR-{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}
                </small>
            </div>

        </div>

    </td>

    <td>{{ $user->email }}</td>

    <td>
        <span class="role-badge admin-role">
            User
        </span>
    </td>

    <td>
        <span class="status success">
            Active
        </span>
    </td>





</tr>

@empty

<tr>

    <td colspan="6" style="text-align:center;">
        No users found
    </td>

</tr>

@endforelse

</tbody>

                </table>

  <div style="margin-top:20px;">
    {{ $users->links() }}
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