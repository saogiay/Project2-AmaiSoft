<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Views\CategoryService;
use App\Services\Views\ProductService;
use App\Services\DetailProductService;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    private $productService;
    private $detailProduct;

    public function __construct(ProductService $productService, DetailProductService $detailProduct)
    {
        $this->productService = $productService;
        $this->detailProduct = $detailProduct;
    }

    // Trang chủ danh mục
    public function index(Category $category, Request $request)
    {
        $products = $this->productService->getProducts($category->id, $request);

        return view('user.category', [
            'title' => $category->name,
            'products' => $products,
            'category' => $category
        ]);
    }

    // xem thêm sản phẩm
    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->productService->getNewest($page);
        if (count($result) != 0) {
            $html = view('user.products.list', ['products' => $result])->render();

            return response()->json(['html' => $html]);
        }

        return response()->json(['html' => '']);
    }
        //Thong tin san pham
        public function product(Product $product){

            return view('user.products.product',[
                'title' => 'Thông tin sản phẩm',
                'product' => $product,
                'sizes' => $this->detailProduct->getSizeProduct($product->id),
            ]);
        }
        //Lay may theo size san pham
        public function getColor(Request $request){
            $colors = $this->detailProduct->getSizeColor($request);
            return view('user.products.color',[
                'colors' => $colors
            ]);
        }

    public function search_products(Request $request)
    {
        $products = $this->productService->getProducts($request->category_id, $request);

        return view('user.products.list', ['products' => $products])->render();
    }

    public function filter_by(Request $request)
    {
        $products = $this->productService->getProducts($request->category_id, $request);

        return view('user.products.list', ['products' => $products])->render();
    }
}
