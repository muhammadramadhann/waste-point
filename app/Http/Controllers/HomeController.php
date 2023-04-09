<?php

namespace App\Http\Controllers;

use App\Models\Groceries;
use App\Models\User;
use App\Models\Waste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $count_groceries = Groceries::all()->count();
        $count_wastes = Waste::where('status', 'Selesai')->sum('weight');
        $count_users = User::where('is_admin', false)->count();
        return view('pages.home.index', [
            'count_groceries' => $count_groceries,
            'count_wastes' => $count_wastes,
            'count_users' => $count_users
        ]);
    }
}
