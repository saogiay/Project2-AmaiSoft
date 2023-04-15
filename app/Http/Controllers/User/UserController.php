<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\OrderService;
use App\Services\SliderService;
use App\Services\UserService;
use App\Services\VoucherService;

class UserController extends Controller
{
    protected $sliderService;
    protected $userService;
    protected $voucherService;

    protected $orderService;
    public function __construct(SliderService $sliderService, UserService $userService, VoucherService $voucherService, OrderService $orderService){
        $this->sliderService = $sliderService;
        $this->userService = $userService;
        $this->voucherService = $voucherService;
        $this->orderService = $orderService;
    }
    // Home page user
    public function index(){
        return view('user.home',[
            'title' => 'Trang chủ',
            'sliders' => $this->sliderService->getSliders(),
        ]);
    }
    // Introduction website
    public function intro(){
        return view('user.intro',[
            'title' => 'Giới thiệu'
        ]);
    }
    //Contact form
    public function contact(){
        return view('user.contact',[
            'title' => 'Liên hệ'
        ]);
    }
    //quan ly thong tin ca nhan

    public function account(){
        $user = $this->userService->getInfoUser();
        return view('user.persons.account',[
            'title' => 'Thông tin tài khoản',
            'user' => $user
        ]);
    }

    public function updateAddress(UserRequest $request)
    {
        $this->userService->updateAddress($request);
        return redirect()->route('account')->with('msg','cập nhập địa chỉ thành công');
    }

    public function updateUser(UserRequest $request)
    {
        $this->userService->updateUser($request);
        return redirect()->route('account')->with('msg','cập nhập thông tin thành công');
    }

    public function wallet(){
        return view('user.persons.wallet',[
            'title' => 'Ví voucher',
            'vouchers' => $this->voucherService->getOwnVoucher()
        ]);
    }
    public function order(){
        $orders = $this->orderService->getAllOrder();
        return view('user.persons.order',[
            'title' => 'Quản lý đơn hàng',
            'orders' => $orders
        ]);
    }
    //Thong tin san pham
    public function product(){
        return view('user.product',[
            'title' => 'Thông tin sản phẩm'
        ]);
    }
}
