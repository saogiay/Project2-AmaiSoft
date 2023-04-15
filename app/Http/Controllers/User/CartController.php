<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use App\Services\CartService;
class CartController extends Controller
{
    protected $data =[];
    protected $cartService;
    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }
    /*
    *Them san pham vao gio hang
    *@param $request->detail_product_id : ma thong tin san pham
    *@param $request->quantity : so luong dat mua
    */
    public function store(CartRequest $request){
        $data = $request->except('_token','size_id');
        $this->data = $this->cartService->check($data);
        return redirect()
        ->back()
        ->with('success', 'Đã thêm vào giỏ hàng thành công');
    }
    /*
    * Hien thi trang gio hang
    */
    public function index(){
        #xoa session giam gia khi reload page
        session()->forget('discount');
        session()->forget('voucher_id');
        return view('user.cart',[
        'title' => 'Giỏ hàng',
        'carts' => $this->cartService->carts(),
        ]);
    }
    /*
    *Cap nhat so luong gio hang
    *@param $data->id: id thong tin san pham
    *@param $data->quantity: so luong san pham
    */
    public function update(Request $request){
        $data = $this->cartService->getData($request);
        $this->cartService->updateCart($data['quantity'],$data['detail_product_id'],$data['user_id']);
        return response()->json([
            'success' => true,
            'data' => $this->cartService->getTotal()
        ]);

    }
    /*
    *Su dung ma giam gia
    *@param $data->code: ma giam gia
    */
    public function voucher(Request $request){
        $data = $this->cartService->getVoucher($request);
        return response()->json([
            'success' => true,
            'voucher' => $data
        ]);
    }
    /*
    * Xoa san pham trong gio hang
    */

    //dat hang
    public function checkout(CartRequest $request){
            return redirect()->route('processPayment')->withInput($request->all());
    }

    /*
    * Xoa san pham trong gio hang
    */
    public function destroy(Request $request){
        $this->cartService->delete($request->cart_id);
        $data = $this->cartService->afterDelCart();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

}
