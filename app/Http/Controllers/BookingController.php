<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Customer;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'car']);

        // Search
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                // Cari format BKG-0001
                if (preg_match('/BKG-(\d+)/i', $search, $matches)) {

                    $bookingId = (int) $matches[1];

                    $q->orWhere('id', $bookingId);
                }

                // Cari ID langsung
                if (is_numeric($search)) {

                    $q->orWhere('id', $search);
                }

                // Cari Customer
                $q->orWhereHas('customer', function ($customer) use ($search) {

                    $customer->where('name', 'like', "%{$search}%");

                });

                // Cari Mobil
                $q->orWhereHas('car', function ($car) use ($search) {

                    $car->where('name', 'like', "%{$search}%");

                });

                // Cari Status
                $q->orWhere('status', 'like', "%{$search}%");
            });
        }

        // Filter Status
        if ($request->filled('status') && $request->status !== 'all') {

            $query->where('status', $request->status);
        }

        $bookings = $query
            ->orderByDesc('pickup_date')
            ->paginate(10)
            ->withQueryString();

        // =========================
        // STATISTIK BOOKING
        // =========================

        $totalRevenue = Booking::sum('total');

        $totalBookings = Booking::count();

        // Jika belum punya kolom payment_status
        $pendingPayments = 0;

        $paidBookings = $totalBookings;

        if (auth()->user()->role == 'customer') {

    return view('customer.bookings', compact(
        'bookings'
    ));
}

return view('bookings.index', compact(
    'bookings',
    'totalRevenue',
    'totalBookings',
    'pendingPayments',
    'paidBookings'
));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function customerCreate(Car $car)
    {
        return view('customer.create-booking', compact('car'));
    }

    public function customerStore(Request $request)
    {
        $customer = Customer::where(
            'email', 
            auth()->user()->email
        )->first();

        Booking::create([
            'customer_id' => $customer->id,
            'car_id' => $request->car_id,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'total' => $request->total,
            'status' => 'pending'
        ]);

        return redirect()
            ->route('customer.bookings')
            ->with('success', 'Booking berhasil dibuat. Silakan tunggu konfirmasi dari admin.');
        
    }
    public function create()
    {
        $customers = Customer::all();
        $cars = Car::all();

        return view('bookings.create', compact(
            'customers',
            'cars'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'duration' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|string'
        ]);

        Booking::create($validated);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load([
            'customer',
            'car'
        ]);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $customers = Customer::all();
        $cars = Car::all();

        return view('bookings.edit', compact(
            'booking',
            'customers',
            'cars'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'duration' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|string'
        ]);

        $booking->update($validated);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}