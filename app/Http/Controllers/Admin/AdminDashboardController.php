<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groceries;
use App\Models\GroceriesTransaction;
use App\Models\User;
use App\Models\Waste;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $weight_total = Waste::where('status', 'Selesai')->sum('weight');
        $groceries = Groceries::count();
        $users = User::where('is_admin', false)->count();

        $kertas = Waste::where('category', 'Kertas')->where('status', 'Selesai')->sum('weight');
        $plastik = Waste::where('category', 'Plastik')->where('status', 'Selesai')->sum('weight');
        $kaleng = Waste::where('category', 'Kaleng')->where('status', 'Selesai')->sum('weight');
        $jelantah = Waste::where('category', 'Jelantah')->where('status', 'Selesai')->sum('weight');

        $update_waste = Waste::where('status', 'Belum diverifikasi')->count();
        $update_groceries = GroceriesTransaction::where('status', 'Dalam proses')->count();

        return view('pages.admin.main.dashboard', [
            'weight_total' => $weight_total,
            'groceries' => $groceries,
            'users' => $users,
            'kertas' => $kertas,
            'plastik' => $plastik,
            'kaleng' => $kaleng,
            'jelantah' => $jelantah,
            'update_waste' => $update_waste,
            'update_groceries' => $update_groceries,
        ]);
    }

    public function users()
    {
        $number = 1;
        $users = User::where('is_admin', false)->get();
        return view('pages.admin.main.user', [
            'users' => $users,
            'number' => $number,
        ]);
    }
}
