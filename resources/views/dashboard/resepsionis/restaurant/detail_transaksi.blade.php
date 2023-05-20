@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Pesanan {{$no_transaksi}}</h1>
</div>

<div class="row mb-5">
    <div class="col-sm-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h4>Detail Pemesanan</h4>
            </div>
            <div class="card-body row">
                <div class="col-6">
                    <div class="d-flex mb-3">
                        <span>Nama Customer : <b>{{$customer}}</b></span>
                    </div>
                    <div class="d-flex mb-3">
                        <span>Waktu Pemesanan : <b>{{date('d F Y H:i', strtotime($waktu))}}</b></span>
                    </div>
                    <div class="d-flex mb-3">
                        <span>No Kamar : <b>{{$no_kamar}}</b></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex mb-3">
                        <span>Status : <b class="badge {{$status == 'Disajikan' ? 'bg-warning' : 'bg-success'}}">{{$status}}</b></span>
                    </div>
                    <div class="d-flex mb-3">
                        <span>Total Harga : <b>Rp. {{number_format($total_harga)}}</b></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 mb-3">
        <div class="card">
            <div class="card-body">
                <h4>Menu yang dipesan</h4>
            </div>
        </div>
    </div>
    @foreach ($data as $item)
        <div class="col-sm-4 mb-5">
            <div class="card">
                <div class="card-header">
                    <img src="{{asset('menu/' .$item->menu->gambar_menu)}}"  width="100%" height="200px" class="rounded" alt="Tidak ada gambar">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="mb-3">{{$item->menu->nama_menu}}</h5>
                    <span>Harga satuan : <b>Rp. {{number_format($item->menu->harga_menu)}}</b></span>
                    <span>Jumlah dibeli : <b>{{$item->qty}}</b></span>
                    <span>Total Harga : <b>RP. {{number_format($item->total_harga)}}</b></span>
                </div>
            </div>

        </div>
    @endforeach
</div>
@endsection
