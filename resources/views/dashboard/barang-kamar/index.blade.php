@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Barang</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="table-responsive col-lg">
    <a href="/admin/barang-kamar/create" class="btn btn-primary mb-3">Tambah Barang Baru</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Gambar</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangKamars as $barangKamar)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if ($barangKamar->img)
                    <div style="max-height: 350px; max-width: 300px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $barangKamar->img) }}" class="img-fluid mt-4"
                            alt="{{ $barangKamar->nama }}">
                    </div>
                    @else
                    <img src="https://source.unsplash.com/300x200?hotel-room" class="img-fluid mt-4"
                        alt="Kamar {{ $barangKamar->nama }}">
                    @endif
                </td>
                <td>{{ $barangKamar->nama }}</td>
                <td>{{ $barangKamar->jumlah }}</td>
                <td class="text-center">
                    <a href="/admin/barang-kamar/{{ $barangKamar->id }}/edit" class="badge bg-warning"><span
                            data-feather="edit"></span></a>
                    <form action="/admin/barang-kamar/{{ $barangKamar->id }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Anda Yakin?')"><span
                                data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection