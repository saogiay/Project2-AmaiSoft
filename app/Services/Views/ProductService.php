<?php

namespace App\Services\Views;

use App\Models\Category;
use App\Models\Product;

class ProductService
{
    const LIMIT = 8;

    //Lấy sản phẩm gần nhất
    public function getNewest($page = null)
    {
        return Product::orderByDesc('id')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    // Lấy sản phẩm theo danh mục
    public function getProducts($category_id, $request)
    {
        $sub_categories = Category::with(['products', 'childrenRecursive', 'childrenRecursive.products'])
            ->where([
                ['id', $category_id],
                ['status', '1']
            ])
            ->get()
            ->toArray();

        $flatten = $this->flatten($sub_categories);

        foreach ($flatten as $key => $fl) {
            if (!array_key_exists('category_id', $fl)) {
                unset($flatten[$key]);
            }
        }
        $array_products = array_values($flatten);

        $product_Ids = array_map(function ($value) {
            return $value['id'];
        }, $array_products);

        $result = Product::whereIn('id', $product_Ids);

        if ($request->input('search_product')) {
            $request->validate([
                'search_product' => 'required|string|max:50',
            ]);
            $result->where('name', 'LIKE', '%' . $request->input('search_product') . '%')->paginate(12);
        }

        if ($request->input('sort_by')) {
            switch ($request->sort_by) {
                case 'az':
                    $result->orderBy('name');
                    break;
                case 'za':
                    $result->orderBy('name', 'desc');
                    break;
                case 'priceUp':
                    $result->orderBy('price');
                    break;
                case 'priceDown':
                    $result->orderBy('price', 'desc');
                    break;
                default:
                    $result->orderBy('id');
                    break;
            }
        }

        if ($request->input('filter_size') && $request->filter_size != "all") {
            $result->whereHas('detailProducts', function ($query) use ($request) {
                $query->where('size_id', $request->filter_size);
            });
        }

        if ($request->input('filter_color') && $request->filter_color != "all") {
            $result->whereHas('detailProducts', function ($query) use ($request) {
                $query->where('color_id', $request->filter_color);
            });
        }

        return $result
            ->paginate(self::LIMIT)
            ->withQueryString();
    }

    // Lấy mảng hỗn hợp sản phẩm, danh mục con
    public function flatten($array)
    {
        $flatArray = [];

        if (!is_array($array)) {
            $array = (array)$array;
        }

        foreach ($array as $key => $value) {
            if (is_array($value) || is_object($value)) {
                $flatArray = array_merge($flatArray, $this->flatten($value));
            } else {
                $flatArray[0][$key] = $value;
            }
        }

        return $flatArray;
    }
}
