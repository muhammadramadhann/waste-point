@extends('layouts.app')

@section('title', 'Beranda')
    
@section('content')
    @if (session('auth'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="container">
                {{ session('auth') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section id="main-view" class="py-5 mb-4">
        <div class="row justify-content-between">
            <div class="col-lg-6 col-12 mt-lg-3 mt-0">
                <h1 class="fw-bold mb-md-3 mb-2">Jadi agen perubahan, <br><span class="text-green">tukar sampah dari rumah</span></h1>
                <p class="mb-4">Dukung perbaikan tata kelola sampah nasional dengan berupaya <span class="d-xl-block d-inline"> mengurangi dan mendaur ulang sampah bersama Waste Point.</span></p>
                <a href="/penukaran-sampah" class="btn btn-green py-2 px-4 mb-lg-0 mb-5 rounded">
                    <span class="align-middle fw-bold">Tukar Sampah</span>
                    <span class="fa fa-arrow-right ms-2 align-middle" aria-hidden="true"></span>
                </a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/home-illustration.svg') }}" alt="home-illustration" class="w-100">
            </div>
        </div>
    </section>
    
    <section id="stat-view" class="py-4 mb-4">
        <div class="text-center mb-5">
            <h4 class="fw-bold">
                Waste Point adalah organisasi pengelolaan sampah Indonesia dengan misi 
                <span class="d-sm-block d-inline text-green">menjadikan Indonesia bebas dari penumpukan sampah</span>
            </h4>
        </div>
        <div class="row align-items-center text-center">
            <div class="col-md-3 col-6 mb-md-0 mb-3">
                <h2 class="fw-bold text-green">99%</h2>
                <p>Daerah terjangkau</p>
            </div>
            <div class="col-md-3 col-6 mb-md-0 mb-3">
                <h2 class="fw-bold text-green">{{ $count_groceries }}</h2>
                <p>Paket sembako</p>
            </div>
            <div class="col-md-3 col-6">
                <h2 class="fw-bold text-green">{{ $count_wastes }} kg</h2>
                <p>Sampah ditukar</p>
            </div>
            <div class="col-md-3 col-6">
                <h2 class="fw-bold text-green">{{ $count_users }}+</h2>
                <p>Pengguna aktif</p>
            </div>
        </div>
    </section>

    <section id="service-view" class="py-4 mb-4">
        <div class="text-center mb-5">
            <hr class="mb-4 mx-auto">
            <h4 class="fw-bold">Layanan <span class="text-green">Waste Point</span></h4>
        </div>
        <div class="row mb-4 justify-content-center">
            <div class="col-lg-5 col-md-6 col-12 mb-md-0 mb-4">
                <div class="card p-md-3 p-1 h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold text-green mb-3">Penukaran Sampah</h4>
                        <p class="card-text opacity-75">Waste Point berupaya menjadi solusi pengelolaan sampah khususnya sampah rumah tangga Anda dengan proses penukaran yang cepat dan mudah.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-12">
                <div class="card p-md-3 p-1 h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold text-green-secondary mb-3">Penukaran Paket Sembako</h4>
                        <p class="card-text opacity-75">Poin yang Anda dapatkan dari penukaran sampah dapat ditukarkan dengan berbagai pilihan paket sembako untuk memberikan kebermanfaatan bagi kebutuhan keluarga.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-12 mb-md-0 mb-4">
                <div class="card p-md-3 p-1 h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold text-green-secondary mb-3">Keamanan Transaksi</h4>
                        <p class="card-text opacity-75">Setiap transaksi yang Anda lakukan melalui Waste Point, terjamin keamananannya sesuai dengan kebijakan kami untuk memberikan kenyamanan dan kemudahan bagi Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-12">
                <div class="card p-md-3 p-1 h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title fw-bold text-green mb-3">Langkah Selanjutnya</h4>
                        <p class="card-text opacity-75">Sampah yang kami terima akan diproses untuk pengelolaan sampah seperti penyaluran ke Bank sampah rekanan Waste Point dan proses daur ulang untuk sampah anorganik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog-view" class="py-lg-5 py-4 mb-4">
        <div class="text-center mb-5">
            <hr class="mb-4 mx-auto">
            <h4 class="fw-bold">Artikel Pilihan</h4>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-12 mb-lg-0 mb-4">
                <div class="card">
                    <img src="{{ asset('images/sample-1.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Pentingnya Pemilahan Jenis Sampah</h6>
                        <p class="card-text opacity-50"><small>23 Maret 2022</small></p>
                        <a href="#" class="text-decoration-none">
                            <span class="text-green">Selengkapnya</span>
                            <span class="fa fa-arrow-right ms-2 align-middle text-green" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-lg-0 mb-4">
                <div class="card">
                    <img src="{{ asset('images/sample-2.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Pentingnya Pemilahan Jenis Sampah</h6>
                        <p class="card-text opacity-50"><small>23 Maret 2022</small></p>
                        <a href="#" class="text-decoration-none">
                            <span class="text-green">Selengkapnya</span>
                            <span class="fa fa-arrow-right ms-2 align-middle text-green" aria-hidden="true"></span>
                        </a>
                    </div>
                  </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-lg-0 mb-4">
                <div class="card">
                    <img src="{{ asset('images/sample-3.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Pentingnya Pemilahan Jenis Sampah</h6>
                        <p class="card-text opacity-50"><small>23 Maret 2022</small></p>
                        <a href="#" class="text-decoration-none">
                            <span class="text-green">Selengkapnya</span>
                            <span class="fa fa-arrow-right ms-2 align-middle text-green" aria-hidden="true"></span>
                        </a>
                    </div>
                  </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-lg-0 mb-4">
                <div class="card">
                    <img src="{{ asset('images/sample-4.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Pentingnya Pemilahan Jenis Sampah</h6>
                        <p class="card-text opacity-50"><small>23 Maret 2022</small></p>
                        <a href="#" class="text-decoration-none">
                            <span class="text-green">Selengkapnya</span>
                            <span class="fa fa-arrow-right ms-2 align-middle text-green" aria-hidden="true"></span>
                        </a>
                    </div>
                  </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('artikel') }}" class="btn btn-green py-2 px-4 mb-lg-0 mb-5 rounded">
                <span class="align-middle">Lihat blog lainnya</span>
                <span class="fa fa-arrow-right ms-2 align-middle" aria-hidden="true"></span>
            </a>
        </div>
    </section>

    <section id="contact-view" class="py-4 mb-4">
        <div class="p-md-5 p-3 bg-green rounded text-center">
            <h3 class="mb-4 fw-bold">Ada Pertanyaan?</h3>
            <a href="https://wa.me/08111761179" target="_blank" class="btn btn-green-secondary rounded py-2 px-md-4 px-2">WhatsApp Admin</a>
        </div>
    </section>

@endsection