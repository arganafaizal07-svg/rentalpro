<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>RentalPro Login</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/style.css') }}">


</head>

<body class="auth-body">


<div class="auth-container">

    <div class="auth-left">

        <div class="auth-content">

            <div class="logo">

                <div class="logo-icon">
                    <i class="fa-solid fa-cube"></i>
                </div>

                <h2>RentalPro</h2>

            </div>

            <h1>
                Manage Your Car Rental Business Efficiently
            </h1>

            <p>
                Track bookings, manage customers, monitor payments, and grow your rental fleet with one dashboard.
            </p>

            <div class="auth-image">
                <i class="fa-solid fa-car-side"></i>
            </div>

        </div>

    </div>

    <div class="auth-right">

        <div class="auth-card">

            <h2>Welcome Back</h2>

            <p>
                Sign in to continue
            </p>

            @if ($errors->any())
                <div style="color:red; margin-bottom:15px;">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('status'))
                <div style="color:green; margin-bottom:15px;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <div class="form-group">

                    <label>Email Address</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@rentalpro.com"
                        required
                        autofocus
                    >

                </div>

                <div class="form-group">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="********"
                        required
                    >

                </div>

                <div class="remember-row">



                </div>

                <button type="submit" class="login-btn">
                    Login
                </button>

            </form>

            <div class="divider">
                OR
            </div>

            <a href="{{ route('register') }}" class="signup-btn">
                Sign Up
            </a>

        </div>

    </div>

</div>

</body>

</html>
