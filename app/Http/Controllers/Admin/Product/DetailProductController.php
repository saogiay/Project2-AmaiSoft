<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailProductRequest;
use App\Models\DetailProduct;
use App\Models\Product;
use App\Services\DetailProductService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class DetailProductController extends Controller
{
    protected $productService;
    protected $detailProductService;
    protected $data = [];

    public function __construct(ProductService $productService, DetailProductService $detailProductService)
    {
        $this->productService = $productService;
        $this->detailProductService = $detailProductService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $sizes = $this->productService->getSizes();
        $colors = $this->productService->getColors();
        $detailProducts = $this->productService->getDetail($product->id);

        return view('admin.products.colorSize.index', [
            'title' => 'Quản lý chi tiết sản phẩm',
            'product' => $product,
            'sizes' => $sizes,
            'colors' => $colors,
            'detailProducts' => $detailProducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, DetailProductRequest $request)
    {
        $data = $request->except('_token');
        $data = $this->productService->getDataCreate($data);
        $this->productService->createDetail($data);

        return redirect()->route('admin.product.detail.index', ['product' => $product->id])->with('msg', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailProduct  $DetailProduct
     * @return \Illuminate\Http\Response
     */
    public function show(DetailProduct $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailProduct  $DetailProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailProduct $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailProduct  $DetailProduct
     * @return \Illuminate\Http\Response
     */
    public function update(DetailProductRequest $request, Product $product, DetailProduct $detail)
    {
        $data = $request->except('_method', '_token');
        $this->productService->updateDetail($data, $detail->id);

        return redirect()->route('admin.product.detail.index', ['product' => $detail->product_id])->with('msg', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailProduct  $DetailProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailProduct $detail)
    {
        //
    }
}
