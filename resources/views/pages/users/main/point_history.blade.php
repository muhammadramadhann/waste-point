@extends('layouts.user')

@section('title', 'Riwayat Konversi Poin')
    
@section('content')
    @if ($waste_histories->isEmpty() && $groceries_histories->isEmpty())
        <div class="flex flex-col justify-content-center text-center mt-5">
            <div class="d-md-block d-none">
                <img src="{{ asset('images/coins.png') }}" class="mb-2 coins history-illustration">
            </div>
            <h6 class="pt-5 mb-5 fw-bold">Ooops, belum ada riwayat perubahan point...</h6>
            <div class="d-md-inline d-block">
                <a href="{{ route('penukaran-sampah') }}" class="btn btn-green me-2 mb-sm-0 mb-2 d-sm-inline d-block w-100">Tukar sampah</a>
                <a href="{{ route('penukaran-sembako') }}" class="btn btn-green-secondary d-sm-inline d-block w-100">Pilih paket sembako</a>
            </div>
        </div>
    @else
        <div class="my-4">
            <h4 class="fw-bold mb-4">Transaksi Sampah</h4>
        </div>
        <div class="table-responsive-md">
            <table class="table align-middle table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">Waktu</th>
                        <th scope="col">Jenis Sampah</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total Point</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($waste_histories->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Belum ada aktivitas penukaran sampah</td>
                        </tr>
                    @else
                        @foreach ($waste_histories as $waste_history)    
                            <tr>
                                <th scope="row">{{ $waste_history->created_at }}</th>
                                <td>{{ $waste_history->category }}</td>
                                <td>
                                    @if ($waste_history->category == $kategori[0] || $waste_history->category == $kategori[1] || $waste_history->category == $kategori[2])
                                        {{ $waste_history->weight }} Kg
                                    @elseif ($waste_history->category == $kategori[3])
                                        {{ $waste_history->weight }} Liter
                                    @endif
                                </td>
                                <td>
                                    +
                                    @switch($waste_history->category)
                                        @case($kategori[0])
                                            {{ $waste_history->weight * 5}}
                                            @break
                                        @case($waste_history->category == $kategori[1])
                                            {{ $waste_history->weight * 8}}
                                            @break
                                        @case($waste_history->category == $kategori[2])
                                            {{ $waste_history->weight * 10}}
                                            @break
                                        @default
                                            {{ $waste_history->weight * 10}}
                                    @endswitch
                                </td>
                                <td><a class="text-green" href="{{ route('user.transaksi-sampah.detail', $waste_history->id) }}">Lihat Detail</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="pagination mt-3 text-center justify-content-end">
            {{ $waste_histories->links() }}
        </div>

        <div class="mt-5 pt-3">
            <h4 class="fw-bold mb-4">Transaksi Sembako</h4>
        </div>
        <div class="table-responsive-md">
            <table class="table align-middle table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">Waktu</th>
                        <th scope="col">Nama Paket</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total Point</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($groceries_histories->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Belum ada aktivitas penukaran paket sembako</td>
                        </tr>
                    @else
                        @foreach ($groceries_histories as $groceries_history)    
                            <tr>
                                <th scope="row">{{ $groceries_history->created_at }}</th>
                                <td>{{ $groceries_history->groceries->package_name }}</td>
                                <td>{{ $groceries_history->quantity }}</td>
                                <td>- {{ $groceries_history->total_points }}</td>
                                <td><a class="text-green" href="{{ route('user.transaksi-sembako.detail', $groceries_history->id) }}">Lihat Detail</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="pagination mt-3 text-center justify-content-end">
            {{ $waste_histories->links() }}
        </div>
    @endif
@endsection