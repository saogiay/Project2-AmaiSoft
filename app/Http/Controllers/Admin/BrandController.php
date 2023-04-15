<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BrandService;
use App\Models\Brand;

class BrandController extends Controller
{
    protected $data = [];
    protected $brandService;
    public function __construct(BrandService $brandService){
        $this->brandService = $brandService;
    }
    /*
    * Danh sach nhan hang
    */
    public function index(){

        return view('admin.brands.index',[
            'title' => 'Danh sách nhãn hàng',
            'brands' => $this->brandService->getAll()
        ]);
    }
    /*
    * Trang them nhan hang
    */
    public function create(){
        return view('admin.brands.add',[
            'title' => 'Thêm nhãn hàng'
        ]);
    }
    /*
    * Xu ly them nhan hang
    */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:brands,name,|max:200'
        ]);

        $data = $request->except('_token');
        $this->data = $this->brandService->getData($data);

        $this->brandService->create($this->data);
        return redirect()->route('admin.brands.create')->with('msg','Thêm nhãn hàng thành công');
    }
    /*
    * thay doi trang thai nhan hang
    */
    public function changeStatus(Request $request)
    {
        $this->brandService->changeStatus($request);
        return response()->json(
            [
                'message' => 'Cập nhật trạng thái thành công'
            ]
        );
    }
    /*
    * Xoa nhan hang
    */
    public function destroy($id)
    {
        $this->brandService->delete($id);
        return redirect(route('admin.brands.index'))->with('success', 'Xóa nhãn hàng thành công');
    }
}
