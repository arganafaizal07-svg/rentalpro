<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | KPI
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Booking::sum('total');

        $totalBookings = Booking::count();

        $newCustomers = Customer::count();

        /*
        |--------------------------------------------------------------------------
        | Fleet Usage (Data Riil)
        |--------------------------------------------------------------------------
        */

        $totalCars = Car::count();

        $usedCars = Booking::whereIn('status', [
                'Confirmed',
                'Ongoing'
            ])
            ->distinct('car_id')
            ->count('car_id');

        $fleetUsage = $totalCars > 0
            ? round(($usedCars / $totalCars) * 100)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Monthly Revenue Chart
        |--------------------------------------------------------------------------
        */

        $monthlyRevenue = Booking::selectRaw(
                'MONTH(pickup_date) as month,
                 SUM(total) as revenue'
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Booking Distribution Chart
        |--------------------------------------------------------------------------
        */

        $bookingDistribution = Booking::select(
                'status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('status')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Top Performing Cars
        |--------------------------------------------------------------------------
        */

        $topCars = Booking::join(
                'cars',
                'bookings.car_id',
                '=',
                'cars.id'
            )
            ->select(
                'cars.name',
                DB::raw('COUNT(bookings.id) as total_bookings'),
                DB::raw('SUM(bookings.total) as revenue')
            )
            ->groupBy(
                'cars.id',
                'cars.name'
            )
            ->orderByDesc('total_bookings')
            ->limit(5)
            ->get();

        return view('reports.index', compact(
            'totalRevenue',
            'totalBookings',
            'newCustomers',
            'fleetUsage',
            'monthlyRevenue',
            'bookingDistribution',
            'topCars'
        ));
    }
}

