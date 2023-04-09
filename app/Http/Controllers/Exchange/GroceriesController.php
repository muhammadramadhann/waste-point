<?php

namespace App\Http\Controllers\Exchange;

use App\Http\Controllers\Controller;
use App\Models\Groceries;
use App\Models\GroceriesTransaction;
use App\Models\User;
use Illuminate\Http\Request;

class GroceriesController extends Controller
{
    public function index()
    {
        $groceries = Groceries::all();
        return view('pages.exchange.groceries.index', [
            'groceries' => $groceries,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->keyword;
        $groceries = Groceries::where('package_name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();
        return view('pages.exchange.groceries.index', [
            'groceries' => $groceries,
        ]);
    }

    public function detail($slug)
    {
        $groceries = Groceries::where('slug', $slug)->first();

        if (is_null($groceries)) {
            return view('not-found');
        }

        return view('pages.exchange.groceries.detail', [
            'groceries' => $groceries,
        ]);
    }

    public function store(Request $request, $slug)
    {
        $groceries = Groceries::where('slug', $slug)->first();
        $user = User::where('id', auth()->user()->id)->first();

        $request->validate([
            'quantity' => ['required', 'min:1', 'integer'],
            'postal_code' => ['required'],
        ]);

        $total_points = $request->quantity * $groceries->price_point;

        if (!auth()->user()->is_admin) {
            if (auth()->user()->waste_poins >= $total_points) {
                GroceriesTransaction::create([
                    'user_id' => auth()->user()->id,
                    'groceries_id' => $groceries->id,
                    'quantity' => $request->quantity,
                    'total_points' => $total_points,
                    'note' => $request->note,
                ]);

                $groceries->stock -= $request->quantity;
                $groceries->update();

                $user->waste_poins -= $total_points;
                $user->postal_code = $request->postal_code;
                $user->update();

                return back()->with('exchange-success', 'Penukaran berhasil diproses! silahkan pantau status dan detail penukaran di dashboard');
            } else {
                return back()->with('exchange-failed', 'Waste Point yang anda miliki masih kurang, ayo tukar sampah sekarang!');
            }
        } else {
            return back()->with('admin-restricted', 'Penukaran paket sembako tidak diproses untuk Admin');
        }
    }
}
