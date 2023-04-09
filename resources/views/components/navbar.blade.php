<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container align-items-center">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/nav-logo.svg') }}" width="105">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav gap-2 ms-lg-5 ms-lg-3 ms-0">
                <li class="nav-item line {{ Request::is('/') ? 'active' : '' }} mt-lg-0 mt-3">
                    <a class="nav-link active" href="/">Beranda</a>
                </li>
                <li class="nav-item line {{ Request::is('penukaran-sampah', 'penukaran-sembako', 'penukaran-sampah/*', 'penukaran-sembako/*') ? 'active' : '' }} dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Penukaran
                    </a>
                    <ul class="dropdown-menu py-0" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('penukaran-sampah') }}">
                                <i class="fa-solid fa-recycle text-green me-2"></i> Sampah
                                <p class="ps-4 mb-0 opacity-50"><small>Tukarkan sampah dapatkan poin.</small></p>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('penukaran-sembako') }}">
                                <i class="fa-solid fa-basket-shopping text-green me-2"></i> Paket Sembako
                                <p class="ps-4 mb-0 opacity-50"><small>Tukar poin dengan berbagai paket sembako.</small></p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item line dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Informasi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Apa itu Waste Point?</a></li>
                        <li><a class="dropdown-item" href="#">Cerita Tentang Kami</a></li>
                    </ul>
                </li>
                <li class="nav-item line {{ Request::is('artikel', 'artikel/*') ? 'active' : '' }}">
                    <a class="nav-link active" href="{{ route('artikel') }}">Artikel</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-register mt-lg-0 mt-3 d-lg-inline d-block rounded">Register</a>
                        <a href="{{ route('login') }}" class="btn btn-login mt-lg-0 mt-2 ms-lg-1 ms-0 d-lg-inline d-block rounded">Login</a>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link active btn-hover rounded dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-lg-2 me-0">{{ Auth::user()->name }}</span>
                            @if (!Auth::user()->is_admin)
                                @if (Auth::user()->avatar == null)
                                <span class="rounded-circle bg-white">
                                    <img src="{{ asset('images/avatar-default.png') }}" alt="avatar" class="avatar rounded-circle">
                                </span>
                                @else
                                    <span class="rounded-circle bg-white">
                                        <img src="{{ asset('avatars/'.Auth::user()->avatar) }}" alt="avatar" class="avatar rounded-circle">
                                    </span>
                                @endif
                            @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdown">
                                @if (!Auth::user()->is_admin)
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('user.dashboard') }}">
                                            <i class="fa fa-user pe-2 text-green me-2" aria-hidden="true"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('user.edit-profile') }}">
                                            <i class="fa fa-cog pe-2 text-green me-2" aria-hidden="true"></i>
                                            Edit Profil
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                            <i class="fa fa-user pe-2 text-green me-2" aria-hidden="true"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider my-0"></li>
                                <li>
                                    <button class="dropdown-item text-danger py-2" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa fa-sign-out me-2" aria-hidden="true"></i>
                                        Logout 
                                    </button>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title fw-bold" id="exampleModalLabel">Konfirmasi Logout</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Anda yakin ingin logout?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
    </div>
</div>