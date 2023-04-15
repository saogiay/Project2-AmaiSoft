<?php


namespace App\Services;


use App\Models\Slider;
use App\Services\BaseService;
use Illuminate\Support\Facades\Storage;

class SliderService extends BaseService 
{
    public function getModel()
    {
        return Slider::class;
    }
    /*
    * Lay danh sach banner
    */
    public function getAll(){
        return  Slider::orderByDesc('id')
        ->simplePaginate(10);
    }
    public function getSliders(){
        return Slider::orderByDesc('id')
        ->where('status','1')
        ->get();
    }
    /*
    * Xu ly du lieu them banner
    *@param $request du lieu nhap tu cac truong input
    *@return $admin_created id admin them
    *@returm $url link anh banner
    */
    public function getData($request){
                $file = $request->file('fileUpload');
                $ext = $request->fileUpload->extension();
                $file_name = time() . '-' .$request->name. '.' .$ext;
                $file->move('storage/sliders',$file_name);
                $request->merge(['url' => $file_name]);
            $request['admin_created'] = $request['admin_updated'] = auth()->user()->id;
            $request->except('_token,fileUpload');
        return $request;
    }
    /*
    * Cap nhat trang thai banner
    */
    public function changeStatus($request)
    { 
        $admin_updated = auth()->user()->id;
        $updated_at = date('Y-m-d H:i:s');
        Slider::find($request->slider_id)->update([
            'status' => $request->status,
            'admin_updated' =>$admin_updated,
            'updated_at' => $updated_at
        ]);
    }
}
