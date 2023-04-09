@extends('layouts.auth')

@section('title', 'Login')
    
@section('content')
    <div class="card auth mx-auto p-3 rounded shadow-sm">
        <div class="card-body">
            @if (session('auth-failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="container">
                        {{ session('auth-failed') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h2 class="fw-bold">Login</h2>
            <p class="mb-4">Silahkan masuk menggunakan akun Waste Point untuk melanjutkan <span class="text-green">aktivitas</span> Anda.</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label fw-bolder">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" autofocus required value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bolder">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required value="{{ old('password') }}">
                    <i class="fa-solid fa-eye-slash" id="togglePassword" onclick="togglePassword()"></i>
                    @error('password')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="float-start">
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-green w-100 py-2 fw-bold rounded">Login</button>
                </div>
                <p class="text-center mb-0">Belum punya akun?
                    <a href="{{ route('register') }}" class="text-decoration-none hover-none text-green fw-bold">Daftar</a>
                </p>
            </form>
        </div>
    </div>
@endsection