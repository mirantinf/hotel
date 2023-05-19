@extends('layouts.booking')

@section('container')

@if ($tipe_kamar->stok > 1)

<div class="container">
    <form action="/booking" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="mb-3" style="margin-top: 30px; width: 100%;">
            <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
            <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror" name="nama_pemesan"
                id="nama_pemesan" value="{{ old('nama_pemesan') }}" required autofocus>
            @error('nama_pemesan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3" style="width: 100%;">
            <label for="no_hp" class="form-label">Nomor Handphone</label>
            <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp"
                value="{{ old('no_hp') }}" required>
            @error('no_hp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3" style="width: 100%;">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                value="{{ old('email', auth()->user()->email) }}" required readonly>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3" style="width: 100%;">
            <input type="hidden" name="tipe_kamar_id" value="{{ old('tipe_kamar_id', $tipe_kamar->id) }}">
            @error('tipe_kamar_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <input type="hidden" name="harga" value="{{ old('harga', $tipe_kamar->harga) }}">
            <label for="nama_kamar" class="form-label">Nama Kamar</label>
            <input type="text" class="form-control @error('nama_kamar') is-invalid @enderror" name="nama_kamar"
                id="nama_kamar" value="{{ old('nama_kamar', $tipe_kamar->nama) }}" required readonly>
            @error('nama_kamar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3" style="width: 100%;">
            <input type="hidden" name="tipe_kamar_id" value="{{ old('tipe_kamar_id', $tipe_kamar->id) }}">
            @error('tipe_kamar_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <input type="hidden" name="harga" value="{{ old('harga', $tipe_kamar->harga) }}">
            <label for="barang" class="form-label">Barang Tambahan</label>
            <select class="js-example-basic-multiple form-control" name="barang[]" id="barang" multiple="multiple">
                @foreach ($barangs as $barang)
                <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                @endforeach
            </select>
            @error('barang')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3" style="width: 100%;">
            <input type="hidden" name="stok" value="{{ old('stok', $tipe_kamar->stok) }}">
            <input type="hidden" name="onbook" value="{{ old('onbook', $tipe_kamar->onbook) }}">
            <label for="jml_kamar" class="form-label">Jumlah Kamar</label>
            <input type="number" class="form-control @error('jml_kamar') is-invalid @enderror" name="jml_kamar"
                id="jml_kamar" value="{{ old('jml_kamar') }}" min="1" max="{{ $tipe_kamar->stok }}" required>
            @error('jml_kamar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3" style="width: 100%;">
            <label for="payby" class="form-label">Pilih Metode Pembayaran</label>
            <select class="form-control" name="payby" id="payby" required>
                @if (old('payby'))
                @if (old('payby') == "ONSITE")
                <option value="ONSITE">ONSITE</option>
                @else
                <option value="ONLINE">ONLINE</option>
                @endif
                @else
                <option value="ONSITE">ONSITE</option>
                <option value="ONLINE">ONLINE</option>
                @endif
            </select>
        </div>
        <small>Booking kamar minimal 1 hari sebelum tanggal check-in </small>
        <div class="row">
            <div class="col-md d-flex" style="margin-bottom: 30px;">
                <div class="form-group align-self-stretch d-flex align-items-end">
                    <div class="wrap align-self-stretch">
                        <label for="tgl_checkin">Tanggal Check-in</label>
                        <input type="date" class="form-control @error('tgl_checkin') is-invalid @enderror" name="tgl_checkin" id="tgl_checkin"
                            placeholder="Tanggal Check-in" required>
                        @error('tgl_checkin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md d-flex" style="margin-bottom: 30px;">
                <div class="form-group align-self-stretch d-flex align-items-end">
                    <div class="wrap align-self-stretch">
                        <label for="tgl_checkout">Tanggal Check-out</label>
                        <input type="date" class="form-control @error('tgl_checkout') is-invalid @enderror" name="tgl_checkout" id="tgl_checkout" required>
                        @error('tgl_checkout')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="submit" style="margin-bottom: 20px; width: 300px;">Booking
            Kamar</button>
    </form>
</div>


@else
<center>
    <h1>Maaf seluruh Kamar {{ $tipe_kamar->nama }} telah dipesan!</h1>
</center>
<center>
    <a href="/tipeKamar" class="btn btn-primary">Pesan Kamar Lain</a>
</center>
@endif

<script src="/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>

@endsection