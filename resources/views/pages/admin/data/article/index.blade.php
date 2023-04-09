@extends('layouts.admin')

@section('title', 'Data Artikel')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid mb-5">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="admin-title mb-2 mb-sm-0">Data Artikel</h3>
            <a href="{{ route('admin.artikel.create') }}" class="d-sm-block d-sm-inline-block btn btn-green shadow-sm py-2 px-3 rounded">
                Tambah Artikel <i class="bi bi-file-plus"></i>
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

        @if ($articles->isEmpty())
            <div class="text-center my-3 pb-4">
                <img src="{{ asset('images/product-illustration.png') }}" width="300" class="mb-2">
                <h6 class="mt-3 text-dark fw-bold">Data Artikel masih kosong</h6>
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
                                        <th>Judul</th>
                                        <th>Tanggal Posting</th>
                                        <th>Live Preview</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articles as $article)
                                        <tr>
                                            <th scope="row">{{ $number++ }}</th>
                                            <td>{{ $article->title }}</td>
                                            <td>{{ $article->created_at }}</td>
                                            <td>
                                                <a href="{{ route('artikel.read', $article->slug) }}" target="_blank">{{ $article->title }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.artikel.detail', $article->id) }}" class="btn btn-secondary mb-lg-0 mb-2 me-lg-1 me-0">Detail</a>
                                                <form action="" method="POST" class="d-inline">
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