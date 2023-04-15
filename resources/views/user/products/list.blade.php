@if(count($products) > 0)
<div class="row isotope-grid">
    @foreach ($products as $product)
    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
        <!-- Block2 -->
        <div class="block2">
            <div class="block2-pic hov-img0">
                <img src="{{ $product->getThumb() }}" alt="{{ $product->name }}">
            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l ">
                    <a href="{{route('product',$product->id)}}"
                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                        {{ $product->name }}
                    </a>

                    <span class="stext-105 cl3">
                        {{ number_format($product->price) }} VND
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="col-md-12 my-5 text-center">
    <h2>Không có sản phẩm nào</h2>
</div>
@endif