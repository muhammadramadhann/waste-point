@extends('layouts.admin')

@section('title', 'Data Penukaran Paket Sembako')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <div class="mb-4">
            <h3 class="admin-title py-2">Data Transaksi Penukaran Paket Sembako</h3>
        </div>

        @if ($groceries_transactions->isEmpty())
            <div class="text-center my-3 pb-4">
                <img src="{{ asset('images/product-illustration.png') }}" width="300" class="mb-2">
                <h6 class="mt-3 text-dark fw-bold">Data transaksi masih kosong</h6>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengguna</th>
                                        <th>Paket</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groceries_transactions as $groceries_transaction)
                                        <tr>
                                            <th scope="row">{{ $number++ }}</th>
                                            <td>{{ $groceries_transaction->users->name }}</td>
                                            <td>{{ $groceries_transaction->groceries->package_name }}</td>
                                            <td>{{ $groceries_transaction->quantity }}</td>
                                            @if ($groceries_transaction->status == 'Selesai')
                                                <td class="text-success">{{ $groceries_transaction->status }}</td>        
                                            @elseif ($groceries_transaction->status == 'Dalam pengiriman')
                                                <td class="text-primary">{{ $groceries_transaction->status }}</td>
                                            @else
                                                <td class="text-danger">{{ $groceries_transaction->status }}</td>
                                            @endif
                                            <td>
                                                <a href="{{ route('admin.transaksi-sembako.detail', $groceries_transaction->id ) }}" class="btn btn-secondary mb-lg-0 mb-2 me-lg-1 me-0">Detail</a>
                                                <form action="transaksi-sembako/delete/{{ $groceries_transaction->id }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        </div>
    </div>

@endsection