@extends('dashboard.layouts.main')
@section('css')
    <style>
        option[disabled] {
            background-color: #6d6d6d6e;
            color: #ffffff;
        }
    </style>
@endsection
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Transaksi Restoran</h1>
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
                <div class="card-header d-flex justify-content-between">
                    <h5>Buat Transaksi</h5>
                    <button class="btn btn-primary" id="addRow">+Tambah Menu</button>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksi-store') }}" method="post">
                        @csrf
                        @error('id_menu')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        @enderror
                        @error('qty')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        @enderror
                        <div id="menu-input">
                            <div class="menu-row col-sm-12 row mb-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Menu</label>
                                        <select name="id_menu[]" class="form-select" required>
                                            <option value="" selected disabled>--Pilih Menu--</option>
                                            @foreach ($menu as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ intval($item->stok) <= 1 ? 'disabled' : '' }}>{{ $item->nama_menu }},
                                                    Stok : {{ $item->stok }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Kuantitas</label>
                                        <input type="number" class="form-control" name="qty[]" placeholder="1" required>
                                    </div>
                                </div>
                                <div class="col-sm-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger delete">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="no_kamar">Nomor Kamar</label>
                            <input type="number"
                                class="form-control @error('no_kamar')
                                is-invalid
                            @enderror"
                                name="no_kamar" placeholder="244">
                            @error('no_kamar')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_customer">Nama Customer</label>
                            <input type="text"
                                class="form-control @error('nama_customer')
                            is-invalid
                        @enderror"
                                name="nama_customer" placeholder="Asep">
                            @error('nama_customer')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-12 mb-5">
            <div class="card">
                <div class="card-header">
                    <h5>Data Transaksi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Transaksi</th>
                                    <th>Nama Customer</th>
                                    <th>Nomor Kamar</th>
                                    <th>Total Harga </th>
                                    <th>Status</th>
                                    <th>Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_transaksi }}</td>
                                        <td>{{ $item->nama_customer }}</td>
                                        <td>{{ $item->no_kamar }}</td>
                                        <td>Rp. {{ number_format($item->total_harga) }}</td>
                                        <td>
                                            @if ($item->status == 'Disajikan')
                                                <span class="badge bg-warning">Disajikan</span>
                                            @else
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 'Disajikan')
                                                <form action="{{ route('transaksi-update', $item->no_transaksi) }}"
                                                    method="post">
                                                    @method('put')
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning mb-2">Ubah ke
                                                        selesai</button>
                                                </form>
                                            @endif
                                            <button data="{{ $item->no_transaksi }}"
                                                class="btn btn-info btn-detail">Detail</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            var menu = [];
            @foreach ($menu as $item)
                menu.push({
                    'id': '{{ $item->id }}',
                    'nama_menu': '{{ $item->nama_menu }}'
                })
            @endforeach

            $("#addRow").click(function() {
                var loopMenu = ''
                for (let i = 0; i < menu.length; i++) {
                    loopMenu += `<option value="` + menu[i].id + `">` + menu[i].nama_menu + `</option>`;
                }
                var newRow = `<div class="menu-row col-sm-12 row mb-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Menu</label>
                                        <select name="id_menu[]" class="form-select" required>
                                            <option value="" selected disabled>--Pilih Menu--</option>
                                            ` + loopMenu + `
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Kuantitas</label>
                                        <input type="number" class="form-control" name="qty[]" placeholder="1" required>
                                    </div>
                                </div>
                                <div class="col-sm-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger delete">Hapus</button>
                                </div>
                            </div>
                        </div>`;
                $("#menu-input").append(newRow);
            });

            // Delete Row button click event
            $("#menu-input").on("click", ".delete", function() {
                $(this).closest(".menu-row").remove();
            });

            $('.btn-detail').click(function() {
                var no = $(this).attr('data');
                var url = '{{ route('transaksi-detail', ':id') }}';
                url = url.replace(':id', no);
                window.location = url;
            })
        })
    </script>
@endsection
