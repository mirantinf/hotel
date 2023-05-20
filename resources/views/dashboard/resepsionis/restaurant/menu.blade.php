@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Menu Restoran</h1>
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
        @foreach ($menu as $item)
            @if ($item->stok < 10)
                <div class="col-sm-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        Stok menu {{ $item->nama_menu }} tersisa {{ $item->stok }} segera isi stok menu tersebut <a
                            href="{{ route('menu.detail', $item->id) }}">disini</a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                </div>
            @endif
        @endforeach
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Data Menu</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Harga Menu</th>
                                    <th>Gambar Menu</th>
                                    <th>Stok</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="body-menu">
                                @forelse ($menu as $item)
                                    <tr>
                                        <td>{{ $item->nama_menu }}</td>
                                        <td>RP. {{ number_format($item->harga_menu) }}</td>
                                        <td><img src="{{ asset('menu/' . $item->gambar_menu) }}" alt="Tidak ada gambar"
                                                width="100px" height="50px"></td>
                                        <td>{{ $item->stok }}</td>
                                        <td>{{ ucfirst($item->kategori) }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            <button type="button" data-id="{{ $item->id }}"
                                                class="btn btn-sm btn-warning mb-2 btn-detail">Detail</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="7">Tidak Ada Menu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $menu->links() }}
                </div>
            </div>

        </div>
    </div>
    <script>
        $('.btn-detail').click(function() {
            var id = $(this).attr('data-id')
            var url = '{{ url('resepsionis/menu') }}' + '/' + id + '/detail';
            window.location = url;
        })
    </script>
@endsection
