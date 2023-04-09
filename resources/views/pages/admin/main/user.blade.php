@extends('layouts.admin')

@section('title', 'Data Pengguna')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid mb-5">

        <!-- Page Heading -->
        <div class="mb-4">
            <h3 class="admin-title py-2">Data Pengguna Aktif Waste Point</h3>
        </div>

        @if ($users->isEmpty())
            <div class="text-center my-3 pb-4">
                <img src="{{ asset('images/waste-illustration.svg') }}" width="250" class="mb-2">
                <h6 class="mt-3 text-dark fw-bold">Data pengguna masih kosong</h6>
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
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Nomor Hp</th>
                                        <th>Poin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $number++ }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->no_hp }}</td>
                                            <td>{{ $user->waste_poins }}</td>
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