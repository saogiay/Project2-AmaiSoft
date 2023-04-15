<?php

namespace App\Services;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\DetailProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\Thumb;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DetailProductService extends BaseService
{
    protected $data = [];

    public function getModel()
    {
        return DetailProduct::class;
    }

    /*
    *Lay size san pham
    *@param $product id san pham
    *return cac size_id san pham
    */
    public function getSizeProduct($product){
        return  DetailProduct::select('size_id')
        ->where('product_id',$product)
        ->groupBy('size_id')
        ->get();
    }
        /*
    *Lay mau san pham theo size
    *@param $product id san pham
    *@param size_id san pham
    *return color_id san pham
    */
    public function getSizeColor($request){
        return DetailProduct::with('color')->select('id','color_id')
        ->where('product_id',$request->id)
        ->where('size_id',$request->size_id)
        ->get();
    }


}
