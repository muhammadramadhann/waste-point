@extends('layouts.admin')

@section('title', 'Detail Data Artikel')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h3 class="admin-title text-center py-2">Detail Data Artikel</h3>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div id="managed-article" class="card shadow mb-4 mx-auto p-3">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bolder">Judul</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Judul artikel" autofocus value="{{ $article->title }}">
                                @error('title')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="body" class="form-label fw-bolder">Konten Artikel</label>
                                @error('body')
                                    <div class="text-danger my-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input id="body" type="hidden" name="body" value="{{$article->body}}">
                                <trix-editor input="body"></trix-editor>
                            </div>
                            <div class="mb-4">
                                <label for="image" class="form-label fw-bolder">Gambar</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @error('image')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <button type="submit" class="btn btn-green w-100 py-2 fw-bold rounded">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection