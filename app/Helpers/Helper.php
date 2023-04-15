<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    //de quy danh muc san pham trang admin
    public static function category($categories, $parent_id = 0, $char = '')
    {
        $html = '';
        foreach ($categories as $category) {
            if ($category->parent_id == $parent_id) {
                if ($category->status == '1') {
                    $status =   '<td style="color:blue"> Kích hoạt </td>';
                } else {
                    $status =   '<td style="color:red"> Vô hiệu hóa </td>';
                }
                $html .= '
                    <tr>
                        <td>' . $category->id . '</td>
                        <td>' . $char . $category->name . '</td>'
                    . $status .
                    '<td>' . $category->updated_at . '</td>
                        <td class="text-right"> 
                            <a class = "btn btn-primary" href="/admin/categories/' . $category->id . '/edit" >
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                ';
                $html .= self::category($categories, $category->id, $char . '|--');
            }
        }
        return $html;
    }
    // danh muc cha trang user
    public static function danhmuc($categories, $parent_id = 0)
    {
        $html = '';
        foreach ($categories as $category) {
            if ($category->parent_id ==  $parent_id) {
                $url = route('category_filter', $category);
                $html .= '
                    <li class="dropdown-submenu">
                        <a tabindex="-1" href="' . $url . '">' . $category->name . '</a>';
                if (self::isChild($categories, $category->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= self::danhmuc($categories, $category->id);
                    $html .= '</ul>';
                }
                $html .= '</li>
                ';
            }
        }
        return $html;
    }
    //danh muc con trang user
    public static function isChild($categories, $id): bool
    {
        foreach ($categories as $category) {
            if ($category->parent_id == $id) {
                return true;
            }
        }
        return false;
    }
}
