<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Tahun yang dipilih
        $year = $request->year ?? date('Y');

        // Statistik Dashboard
        $totalBookings = Booking::whereYear('pickup_date', $year)
            ->count();

        $totalRevenue = Booking::whereYear('pickup_date', $year)
            ->sum('total');

        $totalCars = Car::count();

        $totalCustomers = Customer::count();

        // Booking terbaru sesuai tahun
        $recentBookings = Booking::with(['customer', 'car'])
            ->whereYear('pickup_date', $year)
            ->orderByDesc('pickup_date')
            ->take(5)
            ->get();

        // Customer terbaru
        $latestCustomers = Customer::latest()
            ->take(5)
            ->get();

        // Pengembalian terdekat
        $upcomingReturns = Booking::with(['customer', 'car'])
            ->whereDate('return_date', '>=', now())
            ->orderBy('return_date')
            ->take(5)
            ->get();

        // Mobil paling sering disewa
        $mostRentedCars = Car::withCount('bookings')
            ->orderByDesc('bookings_count')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'year',
            'totalBookings',
            'totalRevenue',
            'totalCars',
            'totalCustomers',
            'recentBookings',
            'latestCustomers',
            'upcomingReturns',
            'mostRentedCars'
        ));
    }
}