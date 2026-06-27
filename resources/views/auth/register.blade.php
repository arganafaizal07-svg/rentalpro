<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register - RentalPro</title>

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

            <h1>Create Your Rental Business Account</h1>

            <p>
                Start managing your vehicles, bookings, customers and payments in one place.
            </p>

            <div class="auth-image">
                <i class="fa-solid fa-car-side"></i>
            </div>

        </div>

    </div>

    <div class="auth-right">

        <div class="auth-card">

            <h2>Create Account</h2>

            <p>
                Register your account
            </p>

            @if ($errors->any())
                <div style="color:red; margin-bottom:15px;">
                    <ul style="padding-left:20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">

                @csrf

                <div class="form-group">
                    <label>Full Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="John Doe"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="john@email.com"
                        required
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

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="********"
                        required
                    >
                </div>

                <button type="submit" class="login-btn">
                    Create Account
                </button>

            </form>

            <div class="divider">
                OR
            </div>

            <a href="{{ route('login') }}" class="signup-btn">
                Login
            </a>

        </div>

    </div>

</div>


</body>

</html>
