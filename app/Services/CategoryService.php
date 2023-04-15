<?php
namespace App\Services;
use App\Models\Category;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
class CategoryService extends BaseService
{
    protected $data = [];
    //khai bao model cho base service
    public function getModel()
    {
        return Category::class;
    }
    /*
    *Lấy danh sách các danh mục cha
    */
    public function getParent(){
        return  Category::where('status','1')
        ->where('parent_id','0')
        ->get();
    }
        /*
    *Lấy danh sách các danh mục
    */
    public function getAll(){
        return  Category::orderby('id')
        ->simplePaginate(10);
    }
    public function getData($data){
        $this->data = $data;
        $data['admin_created'] = $data['admin_updated'] = 1 ;
        return($data) ;
    }
}
