<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()
            ->paginate(10);

        $totalUsers = User::count();

        return view('users.index', compact(
            'users',
            'totalUsers'
        ));
    }
}