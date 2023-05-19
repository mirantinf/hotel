@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Barang Baru</h1>
</div>

<div class="col-lg-8">
    <form action="/admin/barang-kamar" method="POST" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama barang</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                value="{{ old('nama') }}" required autofocus>
            @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah barang</label>
            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah"
                value="{{ old('jumlah') }}" required autofocus>
            @error('jumlah')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="img" class="form-label @error('img') is-invalid @enderror">Foto Barang</label>
            <img class="img-preview img-fluid col-sm-5 mb-3">
            <input type="file" name="img" id="img" class="form-control" onchange="previewImage()">
            @error('img')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Tambah Barang</button>
    </form>
</div>

<script>
    function previewImage() {
        const image = document.querySelector("#img");
        const imgPreview = document.querySelector(".img-preview");

        imgPreview.style.display = "block";

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREevent) {
            imgPreview.src = oFREevent.target.result;
        }
    }
</script>

@endsection