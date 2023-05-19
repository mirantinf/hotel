@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Kamar Baru</h1>
</div>

<div class="col-lg-8">
    <form action="/admin/tipe-kamar" method="POST" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kamar</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                value="{{ old('nama') }}" required autofocus>
            @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Kamar</label>
            <input id="rupiah" type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga"
                value="{{ old('harga') }}" required min="1">
            @error('harga')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok Kamar</label>
            <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok"
                value="{{ old('stok') }}" required min="1">
            @error('stok')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fkamar" class="form-label">Fasilitas Kamar</label>
            <select class="js-example-basic-multiple form-control" name="fasilitas[]" multiple="multiple" id="fkamar"
                required>
                @foreach ($fkamars as $fkamar)
                <option value="{{ $fkamar->id }}">{{ $fkamar->nama }}</option>
                @endforeach
            </select>
            @error('fasilitas')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="img" class="form-label @error('img') is-invalid @enderror">Foto Kamar</label>
            <img class="img-preview img-fluid col-sm-5 mb-3">
            <input type="file" name="img" id="img" class="form-control" onchange="previewImage()">
            @error('img')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" id="button" class="btn btn-primary">Tambah Kamar</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    /* Dengan Rupiah */
    const dengan_rupiah = document.getElementById('rupiah');
    const buttonSubmit = document.getElementById('button');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    buttonSubmit.addEventListener('click', function(e)
    {
        dengan_rupiah.value = dengan_rupiah.value.replace(/[^,\d]/g, '').toString();
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

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