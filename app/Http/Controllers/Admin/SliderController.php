<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SliderService;
use App\Models\Slider;
class SliderController extends Controller
{
    protected $sliderService;
    protected $data = [];
    public function __construct(SliderService $sliderService){
        $this->sliderService = $sliderService;
    }
    /*
    * Trang index quan ly banner
    */
    public function index(){
        return view('admin.sliders.index',[
            'title' => 'Danh sách banner',
            'sliders' => $this->sliderService->getAll()
        ]);
    }
    /*
    * Form them banner
    */
    public function create(){
        return view('admin.sliders.add',[
            'title' => 'Thêm banner mới'
        ]);
    }
    /*
    * xu ly them banner
    *@param $name ten banne
    *@param $image anh banner
    *return $url link banner
    */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:sliders,name,',
            'fileUpload' => 'required'
        ]);
        $data = $this->sliderService->getData($request);
        $this->data = $data->except('_token','fileUpload');
        $this->sliderService->create($this->data);
        return redirect()->route('admin.sliders.create')->with('msg', 'Thêm banner thành công');
    }
    /*
    * Xoa banner
    */
    public function destroy($id)
    {
        $this->sliderService->delete($id);
        return redirect(route('admin.sliders.index'))->with('success', 'Xóa banner thành công');
    }
    /*
    * thay doi trang thai banner
    */
    public function changeStatus(Request $request)
    {
        $this->sliderService->changeStatus($request);
        return response()->json(
            [
                'message' => 'Cập nhật trạng thái thành công'
            ]
        );
    }
}
