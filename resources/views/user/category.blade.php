@extends('user.main')
@section('content')
<section class="bg0 p-t-150 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-c-m m-tb-10">
                <div
                    class="flex-c-m cl6  fw-lighter size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Lọc
                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Tìm kiếm
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search_product"
                        placeholder="Tìm kiếm" id="search_product" onchange="searchProduct()" maxlength="50">
                </div>
            </div>

            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27 col-4">
                        <div class="cl2 p-b-15">
                            Sắp xếp
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="#" class="filter-link trans-04 filter-cus filter-cus" name="sort"
                                    data-query="az">
                                    Tên A->Z
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="#" class="filter-link trans-04 filter-cus" name="sort" data-query="za">
                                    Tên Z->A
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="#" class="filter-link  trans-04 filter-cus" name="sort" data-query="priceUp">
                                    Giá ▲
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="#" class="filter-link  trans-04 filter-cus" name="sort" data-query="priceDown">
                                    Giá ▼
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-col2 p-r-15 p-b-27 col-4">
                        <div class=" cl2 p-b-15">
                            Size
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="#" class="filter-link trans-04 filter-cus" name="size" data-query="all">
                                    Tất cả
                                </a>
                            </li>

                            @foreach ($sizes as $size)
                            <li class="p-b-6">
                                <a href="#" class="filter-link trans-04 filter-cus" name="size"
                                    data-query="{{ $size->id }}">
                                    {{ $size->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="filter-col3 p-r-15 p-b-27 col-4">
                        <div class="cl2 p-b-15">
                            Màu sắc
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="#" class="filter-link trans-04 filter-cus" name="color" data-query="all">
                                    Tất cả
                                </a>
                            </li>
                            @foreach ($colors as $color)
                            <li class="p-b-6">
                                <span class="fs-15 lh-12 m-r-6" style="color: {{ $color->code }};">
                                    <i class="zmdi zmdi-circle"></i>
                                </span>

                                <a href="#" class="filter-link trans-04 filter-cus" name="color" data-query="{{ $color->id }}">
                                    {{ $color->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="loadProduct">
            @include('user.products.list')
            {!! $products->links() !!}
        </div>
    </div>
</section>
<script>
    function searchProduct() {
        let query = $('#search_product').val();
	    $.ajax({
		    url: "{{ route('search_products') }}",
		    type: 'GET',
		    data: { 
                category_id: {{ $category->id }},
                search_product: query,
			    _token: "{{ csrf_token() }}" 
		    },
		    success: function (result) {
                $('#loadProduct').html(result);
		    }
	    })
    }

    let sort_by = null;
    let filter_size = null;
    let filter_color = null;

    $(".filter-cus").click(function(){
        switch ($(this).attr('name')) {
            case "sort":
                $("[name='sort']").removeClass("filter-link-active");
                break;
            case "size":
                $("[name='size']").removeClass("filter-link-active");
                break;
            case "color":
                $("[name='color']").removeClass("filter-link-active");
                break;
            default:
        }

        $(this).addClass("filter-link-active");

        $(".filter-link-active").each(function(index) {
            switch ($(this).attr('name')) {
                case "sort":
                    sort_by = $(this).data("query");
                    break;
                case "size":
                    filter_size = $(this).data("query");
                    break;
                case "color":
                    filter_color = $(this).data("query");
                    break;
                default:
            }
        });

        sendAjax(sort_by, filter_size, filter_color);
    })

    function sendAjax(sort_by, filter_size) {
        $.ajax({
		    url: "{{ route('filter_by') }}",
		    type: 'GET',
		    data: { 
                category_id: {{ $category->id }},
                sort_by: sort_by, 
                filter_size: filter_size,
                filter_color: filter_color,
			    _token: "{{ csrf_token() }}" 
		    },
		    success: function (result) {
                $('#loadProduct').html(result);
		    }
	    })
    }
</script>
@endsection