<?php

namespace App\Http\Controllers\Exchange;

use App\Http\Controllers\Controller;
use App\Models\Waste;
use Illuminate\Http\Request;

class WasteController extends Controller
{
    public function index()
    {
        return view('pages.exchange.waste.index');
    }

    public function store(Request $request)
    {
        // $formatted = str_replace(".", "", $request->weight);
        // dd(intval($formatted));
        $request->validate([
            'weight' => ['required', 'min:1', 'integer'],
            'category' => ['required'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,svg,PNG,JPG,JPEG', 'max:2048'],
        ]);

        if (!auth()->user()->is_admin) {
            $waste_image = auth()->user()->name . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('wastes'), $waste_image);
            $random_string = rand();

            Waste::create([
                'nanoid' => md5($random_string),
                'user_id' => auth()->user()->id,
                'weight' => $request->weight,
                'category' => $request->category,
                'address' => $request->address,
                'image' => $waste_image,
                'note' => $request->note,
            ]);
            return redirect('penukaran-sampah#input-data')->with('exchange-success', 'Penukaran berhasil diproses! silahkan pantau status dan detail penukaran di dashboard');
        } else {
            return redirect('penukaran-sampah#input-data')->with('admin-restricted', 'Penukaran sampah tidak diproses untuk Admin');
        }
    }
}
