@extends('layouts.main')

@section('container')


<div class="hero-wrap" style="background-image: url('images/bg_3.jpg');">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text d-flex align-itemd-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
				<div class="text">
					<p class="breadcrumbs mb-2"><span class="mr-2"><a href="/">Home</a></span> <span>Restaurant</span></p>
					<h1 class="mb-4 bread">Restaurant</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section ftco-no-pb ftco-room">
	<div class="container-fluid px-0">
		<div class="row no-gutters justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<h2 class="mb-4">List Menu</h2>
                <h5>Jika ingin memesan makanan silakan pesan dengan menelfon Resepsionis</h5>
			</div>
		</div>
		<div class="row no-gutters d-flex justify-content-center">
            @forelse ($menus as $item)
                <div class="col-sm-3 m-4">
                    <div class="card">
                        <div class="card-header">
                            <img src="{{asset('menu/'.$item->gambar_menu)}}" width="100%" height="250px" alt="">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5>{{$item->nama_menu}}</h5>
                            <span>{{$item->deskripsi}}</span>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <span>Rp. {{number_format($item->harga_menu)}}</span>
                            <span>{{ucfirst($item->kategori)}}</span>
                        </div>
                    </div>
                </div>
            @empty


            @endforelse
		</div>
	</div>
</section>




<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
		<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
		<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
			stroke="#F96D00" />
	</svg></div>


<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>
@endsection
