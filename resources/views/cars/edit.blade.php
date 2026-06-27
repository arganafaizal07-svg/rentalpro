<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add New Car - RentalPro</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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

        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="main">
            @csrf
            @method('PUT')
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Car</h1>
                    <p class="subtitle">
                        Update vehicle information
                    </p>
                </div>

                <button type="submit" class="save-btn">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Update Car
                </button>
            </div>

            <div class="form-layout">

                <div class="form-card">
                    <h3>Basic Information</h3>

                    <div class="form-group">
                        <label>Car Name</label>
                        <input type="text" name="name" placeholder="Toyota Fortuner" required value="{{ old('name', $car->name) }}">
                    </div>

                    <div class="form-group">
                        <label>Brand</label>
                        <select name="brand" required>
                            <option value="Toyota" {{ $car->brand == 'Toyota' ? 'selected' : '' }}>Toyota</option>
                            <option value="Honda" {{ $car->brand == 'Honda' ? 'selected' : '' }}>Honda</option>
                            <option value="Mitsubishi" {{ $car->brand == 'Mitsubishi' ? 'selected' : '' }}>Mitsubishi</option>
                            <option value="Suzuki" {{ $car->brand == 'Suzuki' ? 'selected' : '' }}>Suzuki</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" required>
                            <option value="SUV" {{ $car->category == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="MPV" {{ $car->category == 'MPV' ? 'selected' : '' }}>MPV</option>
                            <option value="Sedan" {{ $car->category == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                            <option value="Hatchback" {{ $car->category == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Year</label>
                        <input type="number" name="year" placeholder="2025" required value="{{ old('year', $car->year) }}">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="5">{{ old('description', $car->description) }}</textarea>
                    </div>
                </div>

                <div class="form-card">
                    <h3>Pricing & Details</h3>

                    <div class="form-group">
                        <label>Price Per Day</label>
                        <input type="number" name="price" placeholder="1200000" required value="{{ old('price', $car->price) }}">
                    </div>

                    <div class="form-group">
                        <label>Transmission</label>
                        <select name="transmission">
                            <option value="Automatic" {{ $car->transmission == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                            <option value="Manual" {{ $car->transmission == 'Manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Fuel Type</label>
                        <select name="fuel_type">
                            <option value="Petrol" {{ $car->fuel_type == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                            <option value="Diesel" {{ $car->fuel_type == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="Hybrid" {{ $car->fuel_type == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="Electric" {{ $car->fuel_type == 'Electric' ? 'selected' : '' }}>Electric</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Seats</label>
                        <input type="number" name="seats" placeholder="7" value="{{ old('seats', $car->seats) }}">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="Available" {{ $car->status == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Unavailable" {{ $car->status == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                            <option value="Maintenance" {{ $car->status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-card upload-section">
                <h3>Vehicle Images</h3>
                <div class="upload-box">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <h4>Upload Car Images</h4>
                    <p>Drag & Drop files here or click to browse</p>
                    
                    <input type="file" name="image" accept="image/*">
                    @if($car->image)
                    <div style="margin-top:15px;">
                        <img src="{{ asset('storage/'.$car->image) }}"
                            alt="{{ $car->name }}"
                            style="width:220px;border-radius:10px;">
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-card upload-section">
                <h3>Vehicle Video</h3>
                <div class="upload-box video-upload">
                    <i class="fa-solid fa-video"></i>
                    <h4>Upload Car Video</h4>
                    <p>Upload a promotional video</p>
                    <input
                        type="file"
                        name="video"
                        accept="video/*">
                    @if($car->video)
                        <div class="video-preview">
                            <video controls width="400">
                                <source
                                    src="{{ asset('storage/'.$car->video) }}"
                                    type="video/mp4">
                            </video>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-card">
                <h3>Vehicle Features</h3>
                @php
                $currentFeatures = $car->features ?? [];

                if (!is_array($currentFeatures)) {
                    $currentFeatures = json_decode($currentFeatures, true) ?? [];
                }
                @endphp
                <div class="feature-grid">

                    <label>
                        <input type="checkbox" name="features[]" value="Air Conditioning" {{ in_array('Air Conditioning', $currentFeatures) ? 'checked' : '' }}>
                        Air Conditioning
                    </label>

                    <label>
                        <input type="checkbox" name="features[]" value="Bluetooth" {{ in_array('Bluetooth', $currentFeatures) ? 'checked' : '' }}>
                        Bluetooth
                    </label>

                    <label>
                        <input type="checkbox" name="features[]" value="GPS Navigation" {{ in_array('GPS Navigation', $currentFeatures) ? 'checked' : '' }}>
                        GPS Navigation
                    </label>

                    <label>
                        <input type="checkbox" name="features[]" value="USB Charger" {{ in_array('USB Charger', $currentFeatures) ? 'checked' : '' }}>
                        USB Charger
                    </label>

                    <label>
                        <input type="checkbox" name="features[]" value="Rear Camera" {{ in_array('Rear Camera', $currentFeatures) ? 'checked' : '' }}>
                        Rear Camera
                    </label>

                    <label>
                        <input type="checkbox" name="features[]" value="Leather Seats" {{ in_array('Leather Seats', $currentFeatures) ? 'checked' : '' }}>
                        Leather Seats
                    </label>

                    <label>
                        <input type="checkbox" name="features[]" value="Sunroof" {{ in_array('Sunroof', $currentFeatures) ? 'checked' : '' }}>
                        Sunroof
                    </label>

                    <label>
                        <input type="checkbox" name="features[]" value="Parking Sensor" {{ in_array('Parking Sensor', $currentFeatures) ? 'checked' : '' }}>
                        Parking Sensor
                    </label>
                </div>
            </div>

        </form>

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