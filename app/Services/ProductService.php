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

class ProductService extends BaseService
{
    protected $data = [];

    public function getModel()
    {
        return Product::class;
    }

    public function getDataCreate($data)
    {
        $this->data = $data;
        $data['admin_created'] = $data['admin_updated'] = Auth::user()->id;
        return $data;
    }

    public function getDataUpdate($data)
    {
        $this->data = $data;
        $data['admin_updated'] = Auth::user()->id;
        return $data;
    }

    public function getThumbs($product_id)
    {
        return Thumb::where('product_id', $product_id)->get();
    }

    public function saveImages($request, $product)
    {
        foreach ($request->file('images') as $photo) {
            $imagePath = $photo->path(); // lấy đường dẫn tạm thời của tập tin ảnh
            $fileName = $photo->getClientOriginalName(); // lấy tên tập tin ảnh gốc
            $newFilePath = '/storage/images/products/' . $fileName;
            Storage::move($imagePath, $newFilePath);
            Storage::putFileAs('public/images/products/', $photo, $fileName);
            $thumb = new Thumb();
            $thumb->url = $newFilePath;
            $thumb->product_id = $product->id;
            $thumb->save();
        }
    }

    function deleteImgFromFile($thumb)
    {
        $image_path = public_path() . '\storage\\' . $thumb->url;
        if (file_exists($image_path))
            unlink($image_path);

        Thumb::where('id', $thumb->id)->delete();
    }

    public function getSizes()
    {
        return Size::all();
    }

    public function getColors()
    {
        return Color::all();
    }

    public function getDetail($product_id)
    {
        return DetailProduct::where('product_id',$product_id)->get();
    }

    public function createDetail($data)
    {
        $DetailProduct = new DetailProduct();
        $DetailProduct->create($data)->save();
    }

    public function updateDetail($data, $detail_id)
    {
        return DetailProduct::where('id',$detail_id)->update($data);
    }

    public function getBrands()
    {
        return Brand::all();
    }

    public function getCategories()
    {
        return Category::where('parent_id','!=',0)->get();
    }
}
