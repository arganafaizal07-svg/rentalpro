<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RentalPro - Cars</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container">

       <aside class="sidebar">

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

                <a href="{{ route('cars.index') }}" class="{{ request()->routeIs('cars') ? 'active' : 'active' }}">
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

        <main class="main">
<button id="menu-toggle" class="menu-toggle">
    <i class="fa-solid fa-bars"></i>
</button>
           <div class="topbar">

    {{-- Search Box - Sekarang tanpa form, menggunakan Fetch API --}}
    <div class="search-box" id="searchContainer">

        <i class="fa-solid fa-magnifying-glass search-icon"></i>

        <input
            type="text"
            id="searchInput"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search cars..."
            autocomplete="off"
        >

        {{-- Loading spinner --}}
        <div class="search-spinner" id="searchSpinner">
            <i class="fa-solid fa-circle-notch fa-spin"></i>
        </div>

        {{-- Clear button --}}
        <button class="search-clear" id="searchClear" title="Clear search">
            <i class="fa-solid fa-xmark"></i>
        </button>

    </div>

    <div class="top-actions">

        {{-- Result count badge --}}
        <span class="search-result-count" id="resultCount">
            <i class="fa-solid fa-car"></i>
            <span id="resultNumber">{{ count($cars) }}</span> cars
        </span>

        <button
            class="add-btn"
            onclick="window.location.href='{{ route('cars.create') }}'">

            <i class="fa-solid fa-plus"></i>
            Add New Car

        </button>

    </div>

</div>
            <h1 class="page-title">Cars</h1>
            <p class="subtitle">
                Manage your car inventory
            </p>

            @if(session('success'))
                <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Cars Grid Container - akan di-update oleh Fetch API --}}
            <div class="cars-grid" id="carsGrid">

                @forelse($cars as $car)
                    <div class="car-card" data-car-id="{{ $car->id }}">
                        
                        @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800" alt="Default Car">
                        @endif
                
                        @if($car->video)
            <button
            type="button"
            class="btn-video"
            onclick="openVideo('{{ asset('storage/'.$car->video) }}')">

            🎥 Lihat Video
            </button>
            @endif
                        
        <div class="car-content">
    <h3>{{ $car->name }}</h3>
    <p>{{ $car->brand }} • {{ $car->category }}</p>

    <div class="car-price">
        Rp {{ number_format($car->price, 0, ',', '.') }}/day
    </div>

    <span class="car-status {{ strtolower($car->status) == 'available' ? 'available' : 'unavailable' }}">
        {{ $car->status }}
    </span>

    <div style="margin-top: 15px; display: flex; gap: 10px;">
        <a href="{{ route('cars.edit', $car->id) }}" style="flex: 1; text-align: center; background-color: #ffc107; color: #000; padding: 6px; border-radius: 4px; text-decoration: none; font-size: 13px; font-weight: 500;">
            <i class="fa-solid fa-pen-to-square"></i> Edit
        </a>
        
        <form id="delete-form-{{ $car->id }}"
      action="{{ route('cars.destroy', $car->id) }}"
      method="POST"
      style="flex: 1;">

    @csrf
    @method('DELETE')

    <button
        type="button"
        onclick="openDeleteModal({{ $car->id }}, '{{ $car->name }}')"
        style="width:100%;background-color:#dc3545;color:#fff;padding:6px;border:none;border-radius:4px;cursor:pointer;font-size:13px;font-weight:500;">

        <i class="fa-solid fa-trash"></i> Delete

    </button>

</form>
    </div>
</div>
                    </div>
                @empty
                    <div class="cars-empty-state" style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #888;">
                        <i class="fa-solid fa-car-tunnel" style="font-size: 48px; margin-bottom: 10px;"></i>
                        <p>No cars available in inventory. Click "Add New Car" to add one.</p>
                    </div>
                @endforelse

            </div>



        </main>

    </div>

{{-- ========================================= --}}
{{-- SEARCH REALTIME - Fetch API Script        --}}
{{-- ========================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    // === Elements ===
    const searchInput   = document.getElementById('searchInput');
    const carsGrid      = document.getElementById('carsGrid');
    const searchSpinner = document.getElementById('searchSpinner');
    const searchClear   = document.getElementById('searchClear');
    const resultNumber  = document.getElementById('resultNumber');
    const resultCount   = document.getElementById('resultCount');
    const searchContainer = document.getElementById('searchContainer');

    const SEARCH_URL = "{{ route('cars.search') }}";
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let debounceTimer = null;
    let currentRequest = null;

    // === Toggle clear button visibility ===
    function toggleClearButton() {
        if (searchInput.value.trim().length > 0) {
            searchClear.classList.add('visible');
        } else {
            searchClear.classList.remove('visible');
        }
    }

    // === Initial state ===
    toggleClearButton();

    // === Debounced search ===
    searchInput.addEventListener('input', function () {
        toggleClearButton();

        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {
            performSearch(searchInput.value.trim());
        }, 300);
    });

    // === Clear button ===
    searchClear.addEventListener('click', function () {
        searchInput.value = '';
        toggleClearButton();
        performSearch('');
        searchInput.focus();
    });

    // === Add active class on focus ===
    searchInput.addEventListener('focus', function () {
        searchContainer.classList.add('search-active');
    });

    searchInput.addEventListener('blur', function () {
        searchContainer.classList.remove('search-active');
    });

    // === Perform search with Fetch API ===
    function performSearch(keyword) {

        // Show spinner
        searchSpinner.classList.add('visible');

        // Abort previous request if still running
        if (currentRequest) {
            currentRequest.abort();
        }

        const controller = new AbortController();
        currentRequest = controller;

        const url = SEARCH_URL + '?search=' + encodeURIComponent(keyword);

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            signal: controller.signal
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            renderCars(data.cars, data.count, keyword);
        })
        .catch(error => {
            if (error.name !== 'AbortError') {
                console.error('Search error:', error);
            }
        })
        .finally(() => {
            searchSpinner.classList.remove('visible');
            currentRequest = null;
        });
    }

    // === Render cars into the grid ===
    function renderCars(cars, count, keyword) {

        // Update result count with animation
        resultNumber.textContent = count;
        resultCount.classList.add('count-update');
        setTimeout(() => resultCount.classList.remove('count-update'), 400);

        // Fade out the grid first
        carsGrid.classList.add('grid-fade-out');

        setTimeout(() => {

            // Clear grid
            carsGrid.innerHTML = '';

            if (cars.length === 0) {
                // Empty state
                carsGrid.innerHTML = `
                    <div class="cars-empty-state" style="grid-column: 1 / -1; text-align: center; padding: 60px 40px; color: #888;">
                        <div class="empty-search-icon">
                            <i class="fa-solid fa-magnifying-glass" style="font-size: 52px; margin-bottom: 16px; color: #ff6b0060;"></i>
                        </div>
                        <h3 style="color: #cbd5e1; margin-bottom: 8px; font-size: 18px;">No cars found</h3>
                        <p style="color: #64748b; font-size: 14px;">
                            No results for "<strong style="color: #ff6b00;">${escapeHtml(keyword)}</strong>". Try a different keyword.
                        </p>
                    </div>
                `;
            } else {
                // Render each car card
                cars.forEach((car, index) => {
                    const card = createCarCard(car, index);
                    carsGrid.appendChild(card);
                });
            }

            // Fade in the grid
            carsGrid.classList.remove('grid-fade-out');
            carsGrid.classList.add('grid-fade-in');

            setTimeout(() => {
                carsGrid.classList.remove('grid-fade-in');
            }, 500);

        }, 200); // Wait for fade-out
    }

    // === Create a single car card DOM element ===
    function createCarCard(car, index) {

        const div = document.createElement('div');
        div.className = 'car-card card-animate-in';
        div.dataset.carId = car.id;
        div.style.animationDelay = (index * 0.06) + 's';

        const statusClass = car.status && car.status.toLowerCase() === 'available'
            ? 'available'
            : 'unavailable';

        let videoButton = '';
        if (car.video_url) {
            videoButton = `
                <button type="button" class="btn-video"
                    onclick="openVideo('${escapeHtml(car.video_url)}')">
                    🎥 Lihat Video
                </button>
            `;
        }

        div.innerHTML = `
            <img src="${escapeHtml(car.image_url)}" alt="${escapeHtml(car.name)}">
            ${videoButton}
            <div class="car-content">
                <h3>${highlightKeyword(escapeHtml(car.name), searchInput.value.trim())}</h3>
                <p>${highlightKeyword(escapeHtml(car.brand), searchInput.value.trim())} • ${highlightKeyword(escapeHtml(car.category), searchInput.value.trim())}</p>

                <div class="car-price">
                    ${escapeHtml(car.formatted_price)}/day
                </div>

                <span class="car-status ${statusClass}">
                    ${escapeHtml(car.status)}
                </span>

                <div style="margin-top: 15px; display: flex; gap: 10px;">
                    <a href="${escapeHtml(car.edit_url)}" style="flex: 1; text-align: center; background-color: #ffc107; color: #000; padding: 6px; border-radius: 4px; text-decoration: none; font-size: 13px; font-weight: 500;">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    
                    <form id="delete-form-${car.id}"
                        action="${escapeHtml(car.delete_url)}"
                        method="POST"
                        style="flex: 1;">

                        <input type="hidden" name="_token" value="${CSRF_TOKEN}">
                        <input type="hidden" name="_method" value="DELETE">

                        <button
                            type="button"
                            onclick="openDeleteModal(${car.id}, '${escapeHtml(car.name)}')"
                            style="width:100%;background-color:#dc3545;color:#fff;padding:6px;border:none;border-radius:4px;cursor:pointer;font-size:13px;font-weight:500;">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        `;

        return div;
    }

    // === Utility: escape HTML to prevent XSS ===
    function escapeHtml(text) {
        if (!text) return '';
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return String(text).replace(/[&<>"']/g, m => map[m]);
    }

    // === Utility: highlight matching keyword ===
    function highlightKeyword(text, keyword) {
        if (!keyword || keyword.length === 0) return text;

        const escaped = keyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const regex = new RegExp(`(${escaped})`, 'gi');

        return text.replace(regex, '<mark class="search-highlight">$1</mark>');
    }

    // === Sidebar toggle ===
    const toggleBtn = document.getElementById('menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('hide');
    });

});
</script>

{{-- Video Modal --}}
<div id="videoModal" class="video-modal">

    <div class="video-modal-content">

        <span class="close-video" onclick="closeVideo()">
            <i class="fa-solid fa-xmark"></i>
        </span>

        <video
            id="modalVideo"
            controls>

            <source
                id="videoSource"
                src=""
                type="video/mp4">

        </video>

    </div>

</div>

<script>

function openVideo(video){

    const modal=document.getElementById("videoModal");

    const source=document.getElementById("videoSource");

    const player=document.getElementById("modalVideo");

    source.src=video;

    player.load();

    modal.style.display="flex";

    player.play();

}

function closeVideo(){

    const modal=document.getElementById("videoModal");

    const player=document.getElementById("modalVideo");

    player.pause();

    player.currentTime=0;

    modal.style.display="none";

}

document.getElementById("videoModal").addEventListener("click",function(e){

    if(e.target===this){

        closeVideo();

    }

});

</script>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="delete-modal">

    <div class="delete-modal-content">

        <h3>Delete Vehicle</h3>

        <p id="deleteText">
            Are you sure?
        </p>

        <div class="delete-actions">

            <button
                type="button"
                class="cancel-btn"
                onclick="closeDeleteModal()">

                Cancel

            </button>

            <button
                type="button"
                class="confirm-delete-btn"
                onclick="confirmDelete()">

                Delete

            </button>

        </div>

    </div>

</div>

<script>

let selectedForm = null;

function openDeleteModal(carId, carName){

    document.getElementById('deleteModal').style.display = 'flex';

    document.getElementById('deleteText').innerHTML =
        `Are you sure you want to delete <b>${carName}</b>?`;

    selectedForm =
        document.getElementById('delete-form-' + carId);
}

function closeDeleteModal(){

    document.getElementById('deleteModal').style.display = 'none';

    selectedForm = null;
}

function confirmDelete(){

    if(selectedForm){

        selectedForm.submit();

    }

}

window.addEventListener('click', function(event){

    const videoModal = document.getElementById('videoModal');
    const deleteModal = document.getElementById('deleteModal');

    if(event.target === videoModal){
        closeVideo();
    }

    if(event.target === deleteModal){
        closeDeleteModal();
    }

});

</script>

</body>

</html>