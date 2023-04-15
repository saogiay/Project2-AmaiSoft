<?php

namespace App\Services;

use App\Jobs\SendOrderInvoice;
use App\Models\Cart;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Voucher;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService extends BaseService
{
    protected $data = [];

    public function getModel()
    {
        return Order::class;
    }

    //get data payment(banking)
    public function getDataPayment($request)
    {
        $vnpayOrderId = $request->session()->get('vnpay_order_id');
        $order = Order::findOrFail($vnpayOrderId);
        $this->data['id'] = Auth::user()->carts->max('id');
        $items = Auth::user()->carts;
        $total = 0;
        foreach ($items as $item) {
            $total += $item->quantity * $item->details->product->price;
        }
        if ($order->voucher_id = !null) {
            $total = $total - ($total * ($order->voucher->discount / 100));
        }
        $this->data['total'] = $total;
        return $this->data;
    }

    //lưu thông tin order
    public function createPayment($request)
    {
        // Lấy thông tin khách hàng từ request
        $address = $this->formatAddress($request);
        $voucher_id = null;
        if ($request->old('coupon')) {
            $voucher = Voucher::where('code', $request->old('coupon'))->get();
            $voucher_id = $voucher[0]->id;
        }

        // Tạo một order mới
        $order = Order::create([
            'name' => auth()->user()->name,
            'address' => $address,
            'phone' => auth()->user()->phone,
            'payment' => $request->old('payment'),
            'status' => 0,
            'voucher_id' => $voucher_id,
            'user_id' => auth()->user()->id,
        ]);

        // Lưu mã đơn hàng của VnPay vào session để xử lý khi thanh toán thành công
        $request->session()->put('vnpay_order_id', $order->id);
    }


    //format lại địa chỉ trước khi lưu
    public function formatAddress($request)
    {
        $city = $request->old('city');
        $district = $request->old('district');
        $ward = $request->old('ward');
        $number = $request->old('number');

        $address = '';

        if ($city) {
            $address .= $city . ', ';
        }

        if ($district) {
            $address .= $district . ', ';
        }

        if ($ward) {
            $address .= $ward . ', ';
        }

        if ($number) {
            $address .= $number;
        }

        // Xóa dấu phẩy ở cuối nếu có
        $address = rtrim($address, ', ');

        return $address;
    }

    public function storeOrder($request)
    {
        try {
            DB::beginTransaction();
            // Lấy mã đơn hàng của VnPay từ session
            $vnpayOrderId = $request->session()->get('vnpay_order_id');

            // Tìm order tương ứng trong CSDL và cập nhật trạng thái thanh toán của nó
            $order = Order::findOrFail($vnpayOrderId);
            $order->save();

            // lấy thông tin sản phẩm trong giỏ hàng
            $carts = Auth::user()->carts;

            //lưu thông tin vào order_details
            foreach ($carts as $key => $cart) {
                $orderDetail = DetailOrder::create([
                    'order_id' => $vnpayOrderId,
                    'detail_product_id' => $cart->detail_product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->details->product->price
                ]);

                $orderDetail->save();

                $detailProduct = $cart->details;
                $detailProduct->quantity -= $cart->quantity;
                $detailProduct->save();
            }

            //Xóa giỏ hàng
            $userId = Auth::id();
            Cart::where('user_id', $userId)->delete();
            SendOrderInvoice::dispatch($order);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    //Lấy danh sách hóa đơn của khách hàng
    public function getAllOrder()
    {
        return Order::where('user_id',auth()->user()->id)->paginate(8);
    }
    //
    public function getAllOrders()
    {
        return Order::paginate(8);
    }

    public function changeStatus($request)
    {
        Order::find($request->order_id)->update([
            'status' => $request->new_status
        ]);
    }

    public function getAll()
    {
        return Order::all();
    }

    public function getRevenue()
    {
        return DetailOrder::all()->sum(function ($column) {
            return $column->price * $column->quantity;
        });
    }
}
