<!-- Sidebar -->
<ul class="navbar-nav sidebar bg-white sidebar-light accordion" id="accordionSidebar" style="z-index: 1">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/nav-logo.svg') }}" width="85">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - Data Sampah -->
    <li class="nav-item {{ Request::is('admin/transaksi-sampah', 'admin/transaksi-sampah*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.transaksi-sampah') }}">
            <i class="bi bi-trash3-fill"></i>
            <span>Penukaran Sampah</span>
        </a>
    </li>

    <!-- Nav Item - Data Penukaran Paket Sembako -->
    <li class="nav-item {{ Request::is('admin/transaksi-sembako', 'admin/transaksi-sembako*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.transaksi-sembako') }}">
            <i class="bi bi-bag-check"></i>
            <span>Penukaran Sembako</span>
        </a>
    </li>

    <!-- Nav Item - Sembako -->
    <li class="nav-item {{ Request::is('admin/sembako', 'admin/sembako*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.sembako') }}">
            <i class="bi bi-basket2-fill"></i>
            <span>Data Sembako</span>
        </a>
    </li>
    
    <!-- Nav Item - Artikel -->
    <li class="nav-item {{ Request::is('admin/artikel', 'admin/artikel*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.artikel') }}">
            <i class="bi bi-book"></i>
            <span>Data Artikel</span>
        </a>
    </li>
    
    <!-- Nav Item - Artikel -->
    <li class="nav-item {{ Route::is('admin.data-pengguna') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.data-pengguna') }}">
            <i class="bi bi-person-lines-fill"></i>
            <span>Data User</span>
        </a>
    </li>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Logout -->
    <li class="nav-item">
        <button type="submit" class="btn nav-link py-3 text-danger bg-white" data-toggle="modal" data-target="#logoutModal">
            <i class="bi bi-box-arrow-left text-danger"></i>
            <span>Logout</span>
        </button>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- logout modal -->
<div class="modal modal-delete fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title fw-bold" id="logoutModalLabel">Konfirmasi Logout</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Anda yakin ingin logout?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
    </div>
</div>