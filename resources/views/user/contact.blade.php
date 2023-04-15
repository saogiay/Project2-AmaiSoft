@extends('user.main')
@section('content')
<div class="container mt-5">
	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
        <h1 class="text-center mb-5">LIÊN HỆ VỚI CHÚNG TÔI</h1>
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form>
						<h4 class=" cl2 txt-center p-b-30">
							Gửi email cho chúng tôi
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent p-3 d-flex align-items-center">
                            <i class="fa-solid fa-envelope me-3"></i>
							<input type="text" name="email" placeholder="Email của bạn">
                        
						</div>

						<div class="bor8 m-b-30">
							<textarea class=" cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="Nội dung email"></textarea>
						</div>

						<button class="flex-c-m cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							GỬI
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class=" cl2">
								Địa chỉ
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								Coza Store Center 8th floor, 379 Hudson St, New York, NY 10018 US
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="cl2">
								Số điện thoại
							</span>

                            <p>
                                <a href="tel:+84 123456789">+84 123456789</a>
                            </p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="cl2">
								Hòm thư điện tử
							</span>
                            <p>
                                <a href="mailto:someone@example.com">someone@example.com</a>
                            </p>
						</div>
					</div>
				</div>
			</div>

	</section>	
	
	
	<!-- Map -->
	<div class="map">
		<div class="size-303" id="google_map" data-map-x="40.691446" data-map-y="-73.886787" data-pin="images/icons/pin.png" data-scrollwhell="0" data-draggable="1" data-zoom="11"></div>
	</div>
</div>

@endsection