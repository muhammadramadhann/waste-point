@extends('layouts.admin')

@section('title', 'Data Sembako')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="admin-title mb-2 mb-sm-0">Data Sembako</h3>
            <a href="{{ Route('admin.sembako.create') }}" class="d-sm-block d-sm-inline-block btn btn-green shadow-sm py-2 px-3 rounded">
                Tambah Sembako <i class="bi bi-file-plus"></i>
            </a>
        </div>

        @if (session('create_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('create_success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @elseif (session('update_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('update_success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif

        @if ($groceries->isEmpty())
            <div class="text-center my-3 pb-4">
                <img src="{{ asset('images/product-illustration.png') }}" width="300" class="mb-2">
                <h6 class="mt-3 text-dark fw-bold">Belum ada sembako yang ditambahkan</h6>
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
                                            <th>Nama Paket</th>
                                            <th>Jumlah Poin</th>
                                            <th>Stok Tersedia</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($groceries as $package)
                                        <tr>
                                            <th scope="row">{{ $number++ }}</t>
                                            <td>{{ $package->package_name }}</td>
                                            <td>{{ $package->price_point }}</td>
                                            <td>{{ $package->stock }}</td>
                                            <td>
                                                <a href="{{route('admin.sembako.detail', $package->id)}}" class="btn btn-secondary mb-lg-0 mb-2 me-lg-1 me-0">Detail</a>
                                                <form action="data-produk-pemilahan/delete/{{ $package->id }}" method="POST" class="d-inline">
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
            </div>
        @endif
    </div>
@endsection