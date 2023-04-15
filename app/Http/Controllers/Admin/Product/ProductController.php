<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
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
    public function index()
    {
        $title = 'Quản lí sản phẩm';
        $products = $this->productService->all();

        return view('admin.products.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = $this->productService->getBrands();
        $categories = $this->productService->getCategories();
        return view('admin.products.create', [
            'title' => 'Thêm Sản Phẩm',
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data = $this->productService->getDataCreate($data);
        $this->productService->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công',
            'redirect' => route('admin.product.products.index')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', [
            'title' => 'Thông tin sản phẩm',
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $title = 'Sửa sản phẩm';
        $brands = $this->productService->getBrands();
        $categories = $this->productService->getCategories();
        return view('admin.products.edit', compact('title', 'product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->except('_token', '_method');
        $data = $this->productService->getDataUpdate($data);
        $this->productService->update($data, $product->id);
        return redirect(route('admin.product.products.index'))->with('msg', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productService->delete($product->id);
        return redirect(route('admin.product.products.index'))->with('msg', 'Xóa thành công');
    }
}
