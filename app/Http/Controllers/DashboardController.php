<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalBookings = Booking::count();

        $totalRevenue = Booking::sum('total');

        $totalCars = Car::count();

        // Hitung customer dari tabel users
        $totalCustomers = User::where('role', 'customer')->count();

        // Booking terbaru
        $recentBookings = Booking::with(['customer', 'car'])
            ->latest()
            ->take(5)
            ->get();

        // Customer terbaru
        $latestCustomers = User::where('role', 'customer')
            ->latest()
            ->take(5)
            ->get();

        // Mobil yang akan dikembalikan
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

        // Revenue per bulan
        $revenueChart = Booking::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total) as revenue')
            )
            ->where('status', 'Confirmed')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('dashboard', compact(
            'totalBookings',
            'totalRevenue',
            'totalCars',
            'totalCustomers',
            'recentBookings',
            'latestCustomers',
            'upcomingReturns',
            'mostRentedCars',
            'revenueChart'
        ));
    }
}