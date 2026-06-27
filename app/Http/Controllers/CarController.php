<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Menampilkan daftar semua mobil (Read)
     */
public function index(Request $request)
{
    $query = Car::query();

    if ($request->filled('search')) {

        $search = trim($request->search);

        $query->where(function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%")
              ->orWhere('brand', 'like', "%{$search}%")
              ->orWhere('category', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%")
              ->orWhere('transmission', 'like', "%{$search}%")
              ->orWhere('fuel_type', 'like', "%{$search}%");

        });
    }

    $cars = $query->latest()->get();

    if (auth()->user()->role == 'customer') {
        return view('customer.cars', compact('cars'));
        
    return view('customer.cars', compact('cars'));
    }

return view('cars.index', compact('cars'));

    }

    /**
     * Pencarian mobil secara realtime via Fetch API (JSON response)
     */
    public function search(Request $request)
    {
        $query = Car::query();

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('transmission', 'like', "%{$search}%")
                  ->orWhere('fuel_type', 'like', "%{$search}%");
            });
        }

        $cars = $query->latest()->get();

        // Tambahkan URL gambar lengkap ke setiap mobil
        $cars->transform(function ($car) {
            $car->image_url = $car->image
                ? asset('storage/' . $car->image)
                : 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800';
            $car->video_url = $car->video
                ? asset('storage/' . $car->video)
                : null;
            $car->formatted_price = 'Rp ' . number_format($car->price, 0, ',', '.');
            $car->edit_url = route('cars.edit', $car->id);
            $car->delete_url = route('cars.destroy', $car->id);
            return $car;
        });

        return response()->json([
            'success' => true,
            'count'   => $cars->count(),
            'cars'    => $cars,
        ]);
    }

    /**
     * Menampilkan form untuk tambah mobil baru (Create View)
     */
    public function create()
    {
        // Mengarahkan ke file resources/views/cars/create.blade.php
        return view('cars.create');
    }

    /**
     * Menyimpan data mobil baru dari form ke database (Store Action)
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan form agar data wajib diisi sesuai tipe datanya
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'brand'        => 'required|string',
            'category'     => 'required|string',
            'year'         => 'required|integer',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric',
            'transmission' => 'required|string',
            'fuel_type'    => 'required|string',
            'seats'        => 'required|integer',
            'status'       => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video'        => 'nullable|mimes:mp4,mov,avi|max:20480',
            'features'     => 'nullable|array',
        ]);

        // 2. Handle upload gambar mobil jika ada file yang diunggah
        if ($request->hasFile('image')) {
            // Menyimpan gambar ke folder public/storage/cars
            $imagePath = $request->file('image')->store('cars', 'public');
            $validated['image'] = $imagePath;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('cars/videos', 'public');
            $validated['video'] = $videoPath;
        }
        // 3. Simpan seluruh data yang tervalidasi ke database via Model Car
        Car::create($validated);

        // 4. Alihkan halaman kembali ke index mobil dengan pesan sukses
        return redirect()->route('cars.index')->with('success', 'Car data added successfully!');
    }

    /**
     * Menampilkan detail lengkap untuk satu mobil (Show Detail)
     */
    public function show(Car $car)
    {
        // Mengarahkan ke file resources/views/cars/show.blade.php membawa data 1 mobil spesifik
        return view('cars.show', compact('car'));
    }

    /**
     * Menampilkan form untuk mengedit data mobil (Edit View)
     */
    public function edit(Car $car)
    {
        // Mengarahkan ke file resources/views/cars/edit.blade.php membawa data mobil yang mau diedit
        return view('cars.edit', compact('car'));
    }

    /**
     * Menyimpan perubahan data mobil yang di-edit (Update Action)
     */
    public function update(Request $request, Car $car)
    {
        // 1. Validasi data edit
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'brand'        => 'required|string',
            'category'     => 'required|string',
            'year'         => 'required|integer',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric',
            'transmission' => 'required|string',
            'fuel_type'    => 'required|string',
            'seats'        => 'required|integer',
            'status'       => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video'        => 'nullable|mimes:mp4,mov,avi|max:20480',
            'features'     => 'nullable|array',
        ]);

        // 2. Handle upload gambar baru jika ada foto yang diganti
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage agar file sampah tidak menumpuk
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            // Simpan gambar yang baru
            $imagePath = $request->file('image')->store('cars', 'public');
            $validated['image'] = $imagePath;
        }
        if ($request->hasFile('video')) {
            if ($car->video) {
                Storage::disk('public')->delete($car->video);
            }

            $videoPath = $request->file('video')
                ->store('cars/videos', 'public');
            $validated['video'] = $videoPath;
        }
        // 3. Update data lama di database dengan data baru yang sudah tervalidasi
        $car->update($validated);

        // 4. Redirect ke index dengan notifikasi sukses
        return redirect()->route('cars.index')->with('success', 'Car data updated successfully!');
    }

    /**
     * Menghapus data mobil dari database (Delete Action)
     */
    public function destroy(Car $car)
    {
        // 1. Hapus file gambar dari folder storage jika mobil tersebut punya gambar
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        if ($car->video) {
            Storage::disk('public')->delete($car->video);
        }
        // 2. Hapus baris data mobil dari database
        $car->delete();

        // 3. Redirect ke index dengan notifikasi sukses hapus data
        return redirect()->route('cars.index')->with('success', 'Car data deleted successfully!');
    }
}