<?php


namespace App\Http\View\Composers;
use App\Models\Category;
use Illuminate\View\View;

class MenuComposer
{
    protected $users;

    public function __construct()
    {
    }
    /*
    * Lay danh sach cac danh muc dang kich hoat
    * return $view->$categories ben trang ViewServices 
    */
    public function compose(View $view)
    {
        $categories = Category::select('*')->where('status','!=', 0)->orderByDesc('id')->get();
        $view->with('categories', $categories);
    }
}
