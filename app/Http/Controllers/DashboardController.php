<?php

namespace App\Http\Controllers;

use App\Models\MembershipCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Gunakan middleware auth untuk memastikan hanya pengguna yang login yang bisa akses
    }

    public function index()
    {
        // Ambil hanya kartu keanggotaan milik pengguna yang login
        $cards = MembershipCard::where('name', Auth::user()->name)->get();
        return view('dashboard', compact('cards'));
    }
}