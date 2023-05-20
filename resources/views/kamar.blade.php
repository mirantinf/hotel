@extends('layouts.main')

@section('container')

<div class="hero-wrap" style="background-image: url('/images/bg_3.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="/">Beranda</a></span> <span class="mr-2"><a
                                href="/tipeKamar">Kamar</a></span> <span>Single Kamar</span></p>
                    <h1 class="mb-4 bread">Detail Kamar</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            @if (session()->has('penuh'))
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show col-lg-6" role="alert">
                    {{ session('penuh') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="col-md-12 ftco-animate">
                @if ($tipe_kamar->img)
                <div class="room-img" style="background-image: url({{ asset('storage/' . $tipe_kamar->img) }});"></div>
                @else
                <div class="single-slider owl-carousel">
                    <div class="item">
                        <div class="room-img" style="background-image: url(/images/room-4.jpg);"></div>
                    </div>
                    <div class="item">
                        <div class="room-img" style="background-image: url(/images/room-5.jpg);"></div>
                    </div>
                    <div class="item">
                        <div class="room-img" style="background-image: url(/images/room-6.jpg);"></div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
                <h2 class="mb-4">{{ $tipe_kamar->nama }} <span>- ({{ $tipe_kamar->stok }} Available rooms)</span></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean fringilla consequat ultrices. Ut fermentum pulvinar fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut maximus libero ipsum. Duis a ante eu elit tempus pulvinar maximus vitae turpis. Quisque et purus egestas, suscipit tortor id, scelerisque mi. Cras pharetra, nisi vel congue molestie, odio augue cursus elit, et maximus metus enim aliquam lectus. Nam posuere nisi a nisl iaculis scelerisque.</p>
                <div class="d-md-flex mt-5 mb-5">
                    <ul class="list">
                        <li><span>Max:</span> 3 Orang</li>
                        <li><span>Size:</span> 45m</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 properties-single ftco-animate mb-5 mt-4 pl-md-5">
                <h4 class="mb-4"></h4>Fasilitas Kamar
                    <ul class="list">
                            @foreach ($tipe_kamar->fasilitasKamars as $fkamar)
                            <li class="text-primary">{{ $fkamar->nama }}</li>
                            @endforeach
                    </ul>
                 </div>
            </div>
            <div class="col-md-12">
                <div class="row m-0 p-md-3 rounded-lg" style="border: 2px dashed #21CC7A">
                    <div class="col-md-10">
                        <h3 class="m-0 pt-2 text-bold">@rupiah($tipe_kamar->harga) /Malam</h3>
                    </div>
                    <div class="col-md-2 p-0 text-center ">
                        <a href="/booking/{{ $tipe_kamar->id }}" class="btn btn-primary rounded-lg px-4 py-3">Pesan Sekarang!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
            stroke="#F96D00" />
    </svg></div>

<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-migrate-3.0.1.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.easing.1.3.js"></script>
<script src="/js/jquery.waypoints.min.js"></script>
<script src="/js/jquery.stellar.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/aos.js"></script>
<script src="/js/jquery.animateNumber.min.js"></script>
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="/js/google-map.js"></script>
<script src="/js/main.js"></script>
@endsection
