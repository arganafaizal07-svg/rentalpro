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

        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="main">
            @csrf 
            <div class="page-header">
                <div>
                    <h1 class="page-title">Add New Car</h1>
                    <p class="subtitle">
                        Add a new vehicle to your rental fleet
                    </p>
                </div>

                <button type="submit" class="save-btn">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Car
                </button>
            </div>

            <div class="form-layout">

                <div class="form-card">
                    <h3>Basic Information</h3>

                    <div class="form-group">
                        <label>Car Name</label>
                        <input type="text" name="name" placeholder="Toyota Fortuner" required value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label>Brand</label>
                        <select name="brand" required>
                            <option value="Toyota">Toyota</option>
                            <option value="Honda">Honda</option>
                            <option value="Mitsubishi">Mitsubishi</option>
                            <option value="Suzuki">Suzuki</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" required>
                            <option value="SUV">SUV</option>
                            <option value="MPV">MPV</option>
                            <option value="Sedan">Sedan</option>
                            <option value="Hatchback">Hatchback</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Year</label>
                        <input type="number" name="year" placeholder="2025" required value="{{ old('year') }}">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="5">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="form-card">
                    <h3>Pricing & Details</h3>

                    <div class="form-group">
                        <label>Price Per Day</label>
                        <input type="number" name="price" placeholder="1200000" required value="{{ old('price') }}">
                    </div>

                    <div class="form-group">
                        <label>Transmission</label>
                        <select name="transmission">
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Fuel Type</label>
                        <select name="fuel_type">
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Hybrid">Hybrid</option>
                            <option value="Electric">Electric</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Seats</label>
                        <input type="number" name="seats" placeholder="7" value="{{ old('seats', 7) }}">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="Available">Available</option>
                            <option value="Unavailable">Unavailable</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>

            </div>  

            <div class="form-card upload-section">
                <div class="form-card upload-section">
    <h3>Vehicle Images</h3>

    <div class="upload-box">
        <i class="fa-solid fa-cloud-arrow-up"></i>

        <h4>Upload Car Image</h4>

        <p>
            Upload a photo of the vehicle
        </p>

        <input
            type="file"
            name="image"
            accept="image/*">
    </div>
</div>
                <h3>Vehicle Video</h3>
                <div class="upload-box video-upload">
                    <i class="fa-solid fa-video"></i>
                    <h4>Upload Car Video</h4>

                    <p>
                        Upload a promotional or showcase video of the vehicle
                    </p>
                    <input type="file" name="video" accept="video/*">
                </div>
            </div>

            <div class="form-card">
                <h3>Vehicle Features</h3>
                <div class="feature-grid">
                    <label><input type="checkbox" name="features[]" value="Air Conditioning"> Air Conditioning</label>
                    <label><input type="checkbox" name="features[]" value="Bluetooth"> Bluetooth</label>
                    <label><input type="checkbox" name="features[]" value="GPS Navigation"> GPS Navigation</label>
                    <label><input type="checkbox" name="features[]" value="USB Charger"> USB Charger</label>
                    <label><input type="checkbox" name="features[]" value="Rear Camera"> Rear Camera</label>
                    <label><input type="checkbox" name="features[]" value="Leather Seats"> Leather Seats</label>
                    <label><input type="checkbox" name="features[]" value="Sunroof"> Sunroof</label>
                    <label><input type="checkbox" name="features[]" value="Parking Sensor"> Parking Sensor</label>
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