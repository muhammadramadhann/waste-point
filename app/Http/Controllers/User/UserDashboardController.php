<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GroceriesTransaction;
use App\Models\User;
use App\Models\Waste;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->get();
        $wastes = Waste::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
        $groceries_transactions = GroceriesTransaction::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
        $weight = Waste::where('user_id', auth()->user()->id)->where('status', 'selesai')->sum('weight');
        $kategori = ['Kertas', 'Plastik', 'Kaleng', 'Jelantah'];

        return view('pages.users.main.dashboard', [
            'user' => $user,
            'wastes' => $wastes,
            'groceries_transactions' => $groceries_transactions,
            'weight' => $weight,
            'kategori' => $kategori,
        ]);
    }

    public function sampah($nanoid)
    {
        $waste = Waste::where('nanoid', $nanoid)->first();
        $kategori = ['Kertas', 'Plastik', 'Kaleng', 'Jelantah'];

        if (is_null($waste)) {
            return view('not-found');
        }

        if ($waste->user_id !== auth()->user()->id) {
            return view('not-found');
        }

        return view('pages.users.transaction.waste.detail', [
            'waste' => $waste,
            'kategori' => $kategori,
        ]);
    }

    public function sembako($nanoid)
    {
        $groceries_transaction = GroceriesTransaction::where('nanoid', $nanoid)->first();
        $status = ['Dalam proses', 'Dalam pengiriman', 'Selesai'];

        if (is_null($groceries_transaction)) {
            return view('not-found');
        }

        if ($groceries_transaction->user_id !== auth()->user()->id) {
            return view('not-found');
        }

        return view('pages.users.transaction.groceries.detail', [
            'groceries_transaction' => $groceries_transaction,
            'status' => $status,
        ]);
    }

    public function update($nanoid)
    {
        $selesai = 'Selesai';
        $groceries_transaction = GroceriesTransaction::where('nanoid', $nanoid)->first();
        $groceries_transaction->update(['status' => $selesai]);
        return back()->with('update_success', 'Transaksi penukaran sembako telah selesai!');
    }

    public function history()
    {
        $kategori = ['Kertas', 'Plastik', 'Kaleng', 'Jelantah'];
        $waste_histories = Waste::where('user_id', auth()->user()->id)->where('status', 'Selesai')->orderBy('created_at', 'desc')->paginate(10);
        $groceries_histories = GroceriesTransaction::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.users.main.point_history', [
            'waste_histories' => $waste_histories,
            'groceries_histories' => $groceries_histories,
            'kategori' => $kategori
        ]);
    }

    public function waste_rating(Request $request, $nanoid)
    {
        $waste = Waste::where('nanoid', $nanoid)->first();
        $waste->update($request->all());
        return back()->with('rating_success', 'Terimakasih! Penilaian Anda sangat berarti buat kami');
    }

    public function groceries_rating(Request $request, $nanoid)
    {
        $groceries_transaction = GroceriesTransaction::where('nanoid', $nanoid)->first();
        $groceries_transaction->update($request->all());
        return back()->with('rating_success', 'Terimakasih! Penilaian Anda sangat berarti buat kami');
    }
}
