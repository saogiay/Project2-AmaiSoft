<?php

namespace App\Services;
use App\Models\DetailProduct;
use App\Models\Cart;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use App\Models\Voucher;
use Symfony\Component\HttpFoundation\Session\Session;

class CartService extends BaseService
{
    protected $data = [];

    public function getModel()
    {
        return Cart::class;
    }
    /*
    * Kiem tra san pham dat hang
    *@param $data->detail_product_id : ID chi tiet san pham
    *@param $data->quantity : So luong dat mua
    *@return: neu san pham da co trong gio hang->cap nhat so luong
    @return: neu san pham chua co trong gio->them san pham vao gio hang
    */
    public function check($data){
        $data['user_id'] = Auth::user()->id;
        $user_id = Auth::user()->id;
                $dem = Cart::where('user_id', $user_id)
                ->where('detail_product_id', $data['detail_product_id'])
                ->count();
            if($dem != 0){
                Cart::where('user_id',$user_id)
                ->where('detail_product_id',$data['detail_product_id'])
                ->update($data);
            }else{
                Cart::insert($data);
            }
    }
    /*
    * Hien thi danh sach gio hang
    */
    public function carts(){
        $user_id = Auth::user()->id;
            return  Cart::where('user_id',$user_id)->get();

    }
    /*
    * Xu ly du lieu khi cap nhat gio hang
    *@param $data: so luong san pham, id chi tiet san pham
    *@return $data->user_id: them id nguoi dung
    */
    public function getData($request){
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;
        return $data;
    }
    //cap nhat so luong gio hang
    public function updateCart($quantity,$detail_product_id,$user_id){
        $cart = Cart::where('detail_product_id',$detail_product_id) //cap nhat so luong san pham
        ->where('user_id',$user_id)->update([
            'quantity' => $quantity
        ]);
        return $cart;
    }
    //Tinh tong tien gio hang sau khi cap nhat
    public function getTotal(){
        $data = [];
        $user_id = Auth::user()->id;
        $items = Cart::where('user_id',$user_id)->get();
        $total = 0;
        foreach( $items as $item){
            $total += $item->quantity * $item->details->product->price; //tinh tong tien cua gio hang
        }
        if(session()->has('discount')){
            $sale = $total*session('discount')/100;
            $total -= $sale;
            $data['sale'] = $sale;
        }else{
            $data['sale'] = 0;
        }
        $data['total'] = $total;
        return $data;
    }
    //kiem tra gia tri voucher
    public function getVoucher($request){
        #xoa session voucher cu
        session()->forget('discount');
        session()->forget('voucher_id');
        #tinh tong tien trong gio hang
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id',$user_id)->get();
        $total = 0;
        foreach( $carts as $cart){
            $total += $cart->quantity * $cart->details->product->price; //tinh tong tien cua gio hang
        }
        #kiem tra voucher hop le
        $voucher = Voucher::select('vouchers.id','vouchers.discount')
        ->join('user_voucher','user_voucher.voucher_id','vouchers.id')
        ->where('vouchers.code',$request->code)
        ->where('user_voucher.quantity','>' ,0)
        ->where('user_voucher.user_id',$user_id)
        ->where('vouchers.status','1')
        ->where('start_day','<',date('Y-m-d H:i:s'))
        ->where('exp','>',date('Y-m-d H:i:s'));
        if($voucher->count() > 0){
            $data = $voucher->first();
            $sale = $total*$data->discount/100;
            $total -= $sale;
            $data['sale'] = $sale;
            $data['total'] = $total;
            #them session voucher moi
            session(['discount' => $data['discount']]);
            session(['voucher_id' => $data['id']]);
            return $data;

        }else{
            return false;
        }
    }
    //Gio hang sau khi xoa
    public function afterDelCart(){
        $data = [];
        $user_id = Auth::user()->id;
        $items = Cart::where('user_id',$user_id)->get();
        $total = 0;
        foreach( $items as $item){
            $total += $item->quantity * $item->details->product->price; //tinh tong tien cua gio hang
        }
        if(session()->has('discount')){
            $sale = $total*session('discount')/100;
            $total -= $sale;
            $data['sale'] = $sale;
        }else{
            $data['sale'] = 0;
        }
        $data['total'] = $total;
        return $data;
    }
}
