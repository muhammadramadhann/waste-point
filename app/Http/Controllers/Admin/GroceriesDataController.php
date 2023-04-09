<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groceries;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class GroceriesDataController extends Controller
{
    public function index()
    {
        $number = 1;
        $groceries = Groceries::all();
        return view('pages.admin.data.groceries.index', [
            'groceries' => $groceries,
            'number' => $number
        ]);
    }

    public function create()
    {
        return view('pages.admin.data.groceries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_name' => ['required'],
            'price_point' => ['required'],
            'stock' => ['required', 'min:1'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,svg,PNG,JPG,JPEG', 'max:2048'],
            'description' => ['required']
        ]);

        $package_image = $request->package_name . '-' . time() . '.' . $request->image->extension();
        $request->image->move(public_path('groceries'), $package_image);

        Groceries::create([
            'package_name' => $request->package_name,
            'slug' => SlugService::createSlug(Groceries::class, 'slug', $request->package_name),
            'price_point' => $request->price_point,
            'stock' => $request->stock,
            'image' => $package_image,
            'description' => $request->description,
        ]);
        return redirect(route('admin.sembako'))->with('create_success', 'Data sembako berhasil ditambahkan!');
    }

    public function detail($id)
    {
        $groceries = Groceries::where('id', $id)->first();

        if (is_null($groceries)) {
            return view('not-found');
        }

        return view('pages.admin.data.groceries.detail', [
            'groceries' => $groceries,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'stock' => ['min:1'],
            'image' => ['image', 'mimes:png,jpg,jpeg,svg,PNG,JPG,JPEG', 'max:2048'],
        ]);

        if ($request->image != null) {
            $package_image = $request->package_name . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('groceries'), $package_image);

            Groceries::where('id', $id)->update([
                'package_name' => $request->package_name,
                'slug' => SlugService::createSlug(Groceries::class, 'slug', $request->package_name),
                'price_point' => $request->price_point,
                'stock' => $request->stock,
                'image' => $package_image,
                'description' => $request->description,
            ]);
        } else {
            Groceries::where('id', $id)->update([
                'package_name' => $request->package_name,
                'slug' => SlugService::createSlug(Groceries::class, 'slug', $request->package_name),
                'price_point' => $request->price_point,
                'stock' => $request->stock,
                'description' => $request->description,
            ]);
        }
        return redirect(route('admin.sembako'))->with('update_success', 'Data sembako berhasil diupdate!');
    }

    public function delete($id)
    {
        Groceries::where('id', $id)->delete();
        return redirect(route('admin.sembako'))->with('update_success', 'Data sembako berhasil dihapus!');
    }
}
