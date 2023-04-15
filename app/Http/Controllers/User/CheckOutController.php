<?php

namespace App\Http\Controllers\User;

use App\Helpers\VNPayHelper;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    protected $data = [];
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    //xử lí thanh toán
    public function processPayment(Request $request)
    {   
        //khi thanh toán online
        if ($request->old('payment') == 1) {
            $this->orderService->createPayment($request);
            $this->data = $this->orderService->getDataPayment($request);
            $vnp_Url = VNPayHelper::generateUrl($this->data);
            return redirect($vnp_Url);
        }
         //khi chọn thanh toán lúc nhận hàng
        else {
            $this->orderService->createPayment($request);
            $this->orderService->storeOrder($request);
            //thông báo kết quả
            return redirect(route('result'))
                ->with('notification', 'Đặt Hàng Thành Công! Bạn sẽ thanh toán khi nhận hàng. Hãy kiểm tra email của bạn.');
        }
    }

    //Kiểm tra trạng thái khi thanh toán online
    public function vnPayCheck(Request $request)
    {
        //Lấy data từ URL(do VNPay gửi về qua $vnp_Returnurl):
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //Mã phản hồi thanh toán
        //kiểm tra data, xem kết quả giao dịch trả về từ VNpay hợp lệ không:
        if ($vnp_ResponseCode != null) {
            //nếu thành công
            if ($vnp_ResponseCode == 00) {
                $this->orderService->storeOrder($request);
                //thông báo kết quả
                return redirect(route('result'))
                    ->with('notification', 'Đặt Hàng Thành Công! Đã thanh toán trực tuyến. Hãy kiểm tra email của bạn.');
            }
            //nếu không thành công
            else {
                return redirect(route('result'))
                    ->with('notification', 'Lỗi:Lỗi Thanh Toán');
            }
        }
    }

    //trả kết quả thanh toán ra view
    public function result()
    {
        $title = 'Thanh toán';
        $notification = session('notification');
        return view('user.checkout.result', compact('notification', 'title'));
    }
}
