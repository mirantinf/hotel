@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Menu {{ $menu->nama_menu }}</h1>
    </div>

    <div class="row mb-5">
        @if (Session::has('success'))
            <div class="col-sm-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            </div>
        @endif
        <div class="col-sm-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Menu</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <div class="d-flex mb-2">
                                <span>Nama Menu : <b>{{ $menu->nama_menu }}</b></span>
                            </div>
                            <div class="d-flex mb-2">
                                <span>Harga Menu : <b>{{ number_format($menu->harga_menu) }}</b></span>
                            </div>
                            <div class="d-flex mb-2">
                                <span>Stok Menu : <b>{{ $menu->stok }}</b></span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <div class="d-flex mb-2">
                                <span>Kategori Menu : <b>{{ ucfirst($menu->kategori) }}</b></span>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <span>Deskripsi :</span>
                                <span>{{ $menu->deskripsi }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Menu</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('menu.update', $menu->id)}}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group mb-2">
                            <label for="stok">Stok</label>
                            <input type="number"
                                class="form-control @error('stok')
                                is-invalid
                            @enderror"
                                name="stok" id="stok" value="{{ $menu->stok }}">
                            @error('stok')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi"
                                class="form-control @error('deskripsi')
                                is-invalid
                            @enderror"
                                cols="30" rows="5">{{ $menu->deskripsi }}</textarea>
                            @error('deskripsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
