@extends('user.main')
@section('content')
<!-- Slider -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-inner">
	@foreach ($sliders as $key=>$slider)
	<div class="carousel-item {{($key == 0) ? "active" : "";}}" >
		<img src="/storage/sliders/{{$slider->url}}" class="d-block w-100" alt="...">
	</div>
	@endforeach
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	<span class="visually-hidden">Next</span>
	</button>
</div>

<!-- Product -->
<section class="bg0 p-t-40 p-b-140">
	<div class="container">
		<div class="p-b-10">
			<h1 class="fw-bolder cl5">
				SẢN PHẨM MỚI NHẤT
			</h1>
		</div>

		<div id="loadProduct" class="mt-5">
			@include('user.products.list')
		</div>

		<!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45" id="btn_loadMore">
            <input type="hidden" id="page" value="1">
            <button onclick="loadMore()" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
				Xem thêm
			</button>
		</div>
	</div>
</section>
<script>
	function loadMore() {
	const page = Number($('#page').val());
	$.ajax({
		url: '/services/load-product',
		type: 'POST',
		dataType: 'JSON',
		data: {
			page: page,
			_token: "{{ csrf_token() }}"
		},
		success: function (result) {
			if (result.html !== '') {
				$('#loadProduct').append(result.html);
				$('#page').val(page + 1 );
			} else {
				alert('Đã hết sản phẩm');
				$('#btn_loadMore').css('display', 'none');
			}
		}
	})
}
</script>
							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
								data-tooltip="Google Plus">
								<i class="fa fa-google-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function loadMore() {
	const page = Number($('#page').val());
	$.ajax({
		url: '/services/load-product',
		type: 'POST',
		dataType: 'JSON',
		data: {
			page: page,
			_token: "{{ csrf_token() }}"
		},
		success: function (result) {
			if (result.html !== '') {
				$('#loadProduct').append(result.html);
				$('#page').val(page + 1 );
			} else {
				alert('Đã hết sản phẩm');
				$('#btn_loadMore').css('display', 'none');
			}
		}
	})
}
</script>
@endsection
