@extends('layouts.user')

@section('title', 'Yang Dicari Gaada')

@section('content')
    <section id="not-found">
        <div class="my-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-12">
                    <img src="{{ asset('images/404.svg') }}" class="w-100">
                </div>
                <h3 class="mt-5 fw-bold text-center">Waduh Halamannya Gaada :(</h3>
            </div>
        </div>
    </section>
@endsection