<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroceriesTransaction;
use Illuminate\Http\Request;

class GroceriesTransactionController extends Controller
{
    public function index()
    {
        $number = 1;
        $groceries_transactions = GroceriesTransaction::orderBy('id', 'desc')->get();
        return view('pages.admin.transaction.groceries.index', [
            'groceries_transactions' => $groceries_transactions,
            'number' => $number
        ]);
    }

    public function detail($id)
    {
        $groceries_transaction = GroceriesTransaction::where('id', $id)->first();
        return view('pages.admin.transaction.groceries.detail', [
            'groceries_transaction' => $groceries_transaction,
        ]);
    }

    public function update(Request $request, $id)
    {
        // status
        $status = ['Dalam proses', 'Dalam pengiriman', 'Selesai'];

        $groceries_transaction = GroceriesTransaction::where('id', $id)->first();

        if ($groceries_transaction->status == $status[2]) {
            if ($request->status == $status[0] || $request->status == $status[1] || $request->status == $status[2]) {
                return back()->with('update_fail', 'Update gagal! transaksi penukaran paket sembako telah selesai');
            }
        } else if ($groceries_transaction->status == $status[1]) {
            if ($request->status == $status[0] || $request->status == $status[1]) {
                return back()->with('update_fail', 'Update gagal! paket sembako sudah dalam pengiriman');
            } else {
                $groceries_transaction->update(['status' => $request->status]);
                return back()->with('update_success', 'Update transaksi penukaran paket sembako berhasil!');
            }
        } else if ($groceries_transaction->status == $status[0]) {
            if ($request->status == $status[2]) {
                return back()->with('update_fail', 'Update gagal! Pengiriman paket sembako belum dilakukan');
            } else if ($request->status == $status[1]) {
                $groceries_transaction->update([
                    'status' => $request->status,
                    'invoice_number' => 'INV/' . rand(2022, 2022) . '/' . rand(1, 9999),
                ]);
                return back()->with('update_success', 'Update transaksi penukaran paket sembako berhasil!');
            } else {
                return back()->with('update_warning', 'Status transaksi penukaran paket sembako belum diupdate!');
            }
        }
    }

    public function delete($id)
    {
        GroceriesTransaction::where('id', $id)->delete();
        return redirect(route('admin.transaksi-sembako'))->with('update_success', 'Transaksi penukaran paket sembako berhasil dihapus!');
    }
}
