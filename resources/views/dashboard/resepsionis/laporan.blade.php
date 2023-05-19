@extends('dashboard.layouts.main')

@section('container')

<style>
    .group {
        display: flex;
        line-height: 28px;
        align-items: center;
        position: relative;
        max-width: 190px;
    }

    .input {
        width: 100%;
        height: 40px;
        line-height: 28px;
        padding: 0 1rem;
        padding-left: 2.5rem;
        border: 2px solid transparent;
        border-radius: 8px;
        outline: none;
        background-color: #fff;
        color: #0d0c22;
        transition: .3s ease;
    }

    .input::placeholder {
        color: #9e9ea7;
    }

    .input:focus,
    input:hover {
        outline: none;
        border-color: rgba(234, 76, 137, 0.4);
        background-color: #fff;
        box-shadow: 0 0 0 4px rgb(234 76 137 / 10%);
    }

    .icon {
        position: absolute;
        left: 1rem;
        fill: #9e9ea7;
        width: 1rem;
        height: 1rem;
    }
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Laporan Transaksi</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="table-responsive col-lg">
    {{-- <a href="/admin/fasilitas-kamar/create" class="btn btn-primary mb-3">Tambah Fasilitas Kamar Baru</a> --}}
    <div class="">
        <input type="text" class="form-control" name="kode" id="kode" placeholder="Search" style="width: 300px;"><br>
    </div>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">No Transaksi</th>
                <th scope="col">Check-in</th>
                <th scope="col">Check-out</th>
                <th scope="col">Tipe Kamar</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode_booking }}</td>
                <td>{{ $item->tgl_checkin }}</td>
                <td>{{ $item->tgl_checkout }}</td>
                <td>{{ $item->tipe_kamar_id }}</td>
                <td>{{ $item->nama_pemesan }}</td>
                <td>{{ $item->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection