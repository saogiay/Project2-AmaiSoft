<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    protected $data = [];
    protected $categoryService;
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }
    /*
    * Danh sach danh muc san pham
    */
    public function index(){
        return view('admin.categories.index',[
            'title' => 'Danh mục sản phẩm',
            'categories' => $this->categoryService->getAll()
        ]);
    }
    /*
    * Form them danh muc san pham
    */
    /*
    * Form them danh muc san pham
    */
    public function create (){
        return view('admin.categories.add',[
            'title' => 'Thêm danh mục',
            'menus' => $this->categoryService->getParent()
        ]);
    }
    /*
    * Them danh muc san pham
    *@param $request
    */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories,name,'
        ]);

        $data = $request->except('_token');
        $data['slug'] = Str::slug($request->name);
        $this->data = $this->categoryService->getData($data);
        $this->categoryService->create($this->data);
        return redirect()->route('admin.categories.create')->with('msg','Thêm danh mục thành công');
    }
    /*
    * Trang cap nhat danh muc san pham
    *@param $category
    */
    public function edit(Category $category){
        return view('admin.categories.edit',[
            'title' => 'Cập nhật danh mục',
            'category' => $category,
            'categories' => $this->categoryService->getParent()->where('id','!=',$category->id)
        ]);
    }
        /*
    * Trang cap nhat danh muc san pham
    *@param $category
    */
    public function update(Request $request,Category $category){
        $request->validate([
            'name' => 'required|unique:categories,name,' .$category->id
        ]);
        $data = $request->except('_method', '_token');
        $this->data = $this->categoryService->getData($data);
        $this->categoryService->update($this->data, $category->id);
        return redirect(route('admin.categories.edit', $category->id))->with('msg', 'Cập nhật danh mục thành công');
    }
}
