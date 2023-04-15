<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Thumb;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ThumbController extends Controller
{
    protected $productService;
    protected $data = [];

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $thumbs = $this->productService->getThumbs($product->id);
        // dd($thumbs);
        return view('admin.products.image.index', [
            'title' => 'Quản lí ảnh sản phẩm',
            'product' => $product,
            'thumbs' => $thumbs
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
    public function store(Request $request, Product $product)
    {
        $this->productService->saveImages($request, $product);

        return redirect(route('admin.product.thumb.index', ['product' => $product->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thumb  $thumb
     * @return \Illuminate\Http\Response
     */
    public function show(Thumb $thumb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thumb  $thumb
     * @return \Illuminate\Http\Response
     */
    public function edit(Thumb $thumb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thumb  $thumb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thumb $thumb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thumb  $thumb
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,Thumb $thumb)
    {
        $this->productService->deleteImgFromFile($thumb);

        return redirect(route('admin.product.thumb.index', ['product' => $product->id]))->with('msg','Xóa thành công');
    }
}
