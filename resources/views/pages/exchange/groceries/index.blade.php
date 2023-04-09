@extends('layouts.app')

@section('title', 'Penukaran Paket Sembako')
    
@section('content')
    <section id="list_groceries" class="pb-2 mb-2">
        <div class="mb-5 pt-5">
            <div class="row justify-content-between mb-5">
                <div class="col-lg-4 col-12 mb-lg-0 mb-4">
                    <div class="sticky-top">
                        <h4 class="fw-bold">Pilihan sembako</h4>
                        <p>Akumulasi point dari penukaran sampah dapat ditukarkan dengan paket sembako berkualitas dan tentu saja bermanfaat bagi anda dan keluarga.</p>
                        @auth
                            <div class="card rounded">
                                <div class="card-body d-flex">
                                    <p class="mb-0 fw-bold">WastePoin</p>
                                    <div class="ms-auto">
                                        <img src="{{ asset('images/points.svg') }}"> 
                                        <span class="align-middle fw-bold">
                                            @if (!Auth::user()->waste_poins == null) {{ Auth::user()->waste_poins }} @else 0 @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('penukaran-sampah') }}" class="btn btn-green w-100">Dapatkan poin lagi</a>
                                </div>
                            </div>
                        @else
                            <div class="card rounded">
                                <p class="mb-0 py-3 text-center">Sepertinya kamu belum masuk menggunakan akun Waste Point, Yuk login dulu!</p>
                                <div class="card-footer">
                                    <a href="{{ route('login') }}" class="btn btn-green w-100">Login sekarang</a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-7 col-12">
                    <form action="{{ route('penukaran-sembako.search') }}" method="get" class="d-flex">
                        <div class="input-group mb-2 shadow-sm rounded">
                            <input type="text" class="form-control input-search" placeholder="Cari nama paket atau produk.." name="keyword" value="{{ request('keyword') }}">
                            <button class="btn btn-green text-white" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>
                    @if ($groceries->isEmpty())
                        <div class="text-center my-5">
                            <h5 class="fw-bold py-4">Saat ini sembako belum tersedia</h5>
                        </div>
                    @else
                        <div class="row justify-content-between mt-4">
                            @foreach ($groceries as $package)
                                <div class="col-lg-6 col-12 mb-4">
                                    <div class="card rounded">
                                        <img src="/groceries/{{ $package->image }}" class="card-img-top">
                                        <div class="card-body">
                                            <h6 class="card-title fw-bold">{{ $package->package_name }}</h6>
                                            <p class="card-text">
                                                <img src="{{ asset('images/points.svg') }}">
                                                <span class="align-middle">{{ $package->price_point }}</span>
                                            </p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item btn-gray">
                                                <a href="{{route('penukaran-sembako.detail', $package->slug )}}" class="w-100 btn shadow-none fw-bold">Tukarkan</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection