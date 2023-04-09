@extends('layouts.app')

@section('title') {{ $article->title.' - Waste Point Article' }} @endsection

@section('content')
    <section id="read_blog" class="pt-4 pb-5">
        <div class="text-center">
            <p class="text-muted">{{ $article->created_at }}</p>
            <h2 class="fw-bold">{{ $article->title }}</h2>
            <div class="article-image py-4">
                <img src="{{ asset('articles/'.$article->image) }}" class="rounded" alt="article-image">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-8 mx-auto col-12 article-body">
                {!! $article->body !!}
            </div>
        </div>
    </section>
@endsection