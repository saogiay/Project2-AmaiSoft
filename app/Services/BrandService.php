<?php
namespace App\Services;
use App\Models\Brand;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
class BrandService extends BaseService
{
    protected $data = [];
    //khai bao model cho base service
    public function getModel()
    {
        return Brand::class;
    }

    /*
    *Lấy danh sách các nhãn hàng
    */
    public function getAll(){
        return Brand::orderby('id')
        ->simplePaginate(10);
    }
    /*
    *Xu ly du lieu admin_id
    */
    public function getData($data){
        $this->data = $data;
        $data['admin_created'] = $data['admin_updated'] = auth()->user()->id;
        return($data) ;
    }
    //Cap nhat trang thai nhan hang
    public function changeStatus($request)
    { 
        $admin_updated = auth()->user()->id;
        $updated_at = date('Y-m-d H:i:s');
        Brand::find($request->brand_id)->update([
            'status' => $request->status,
            'admin_updated' =>$admin_updated,
            'updated_at' => $updated_at
        ]);
    }
}