<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <title>Order Notification</title>
</head>

<body
    style="background-color: #e7eff8; font-family: trebuchet,sans-serif; margin-top: 0; box-sizing: border-box; line-height: 1.5;">
    <div class="container-fluid">
        <div class="container" style="background-color: #e7eff8; width: 600px; margin: auto;">
            <div class="col-12 mx-auto" style="width: 580px;  margin: 0 auto;">

                <div class="row">
                    <div class="container-fluid">
                        <div class="row" style="background-color: #e7eff8; height: 10px;">

                        </div>
                    </div>
                </div>

                <div class="row"
                    style="height: 100px; padding: 10px 20px; line-height: 90px; background-color: white; box-sizing: border-box;">
                    <h1 class="pl-2"
                        style="color: orange; line-height: 30px; float: left; padding-left: 20px; font-size: 40px; font-weight: 500;">
                        AmaiShop
                    </h1>
                </div>

                <div class="row" style="background-color: #00509d; height: 200px; padding: 35px; color: white;">
                    <div class="container-fluid">
                        <h3 class="m-0 p-0 mt-4" style="margin-top: 0; font-size: 28px; font-weight: 500;">
                            <strong style="font-size: 32px;">Thông Báo Đặt Hàng</strong>
                            <br>
                            Cảm ơn bạn!
                        </h3>
                        <div class="row mt-5" style="margin-top: 35px; display: flex;">
                            <div class="col-6"
                                style="margin-bottom: 25px; flex: 0 0 50%; width: 50%; box-sizing: border-box;">
                                <b>{{ $order->user->name }}</b>
                                <br>
                                <span>
                                    <a style="color: white !important;" href="mailto:{{ $order->user->email }}"
                                        target="_blank">{{ $order->email }}</a>
                                </span>
                                <br>
                                <span>{{ $order->phone }}</span>
                            </div>
                            <div class="col-6" style="flex: 0 0 50%; width: 50%; box-sizing: border-box;">
                                <b>Ngày Đặt Hàng:</b> {{ date('d/m/yy H:i', strtotime($order->created_at)) }}
                                <br>
                                <b>Nơi Nhận Hàng:</b> {{ $order->address }}
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2 p-4" style="background-color: white; margin-top: 15px; padding: 20px;">
                    <table>
                        <tr>
                            <td>
                                <img src="https://ci6.googleusercontent.com/proxy/8eUxMUXMkvgUKX8veBCRQM5N7-jXP0Wx8KjQLaGDch2DnV_5HYw9PMgJXsoqgSR_jonTY9jAftWPKNsN5W9cUUneQ9hz7IhxH4rIXNzHMm0ijbsNjHB9m7g6XfJJ=s0-d-e1-ft#https://www.bambooairways.com/reservation/common/hosted-images/tickets.jpg"
                                    alt="">
                            </td>

                            @if ($order->payment == 2)
                            <td class="pl-3" style=" padding-left:15px;">
                                <span class="d-inline"
                                    style="color:#424853; font-family:trebuchet,sans-serif; font-size:16px; font-weight:normal; line-height:22px;">
                                    Bạn sẽ thanh toán khi nhận được hàng. Chúng tôi vừa bàn giao đơn đặt hàng của
                                    bạn cho một đối tác vận chuyển.
                                </span>
                            </td>
                            @endif

                            @if ($order->payment == 1)
                            <td class="pl-3" style=" padding-left:15px;">
                                <span class="d-inline"
                                    style="color:#424853; font-family:trebuchet,sans-serif; font-size:16px; font-weight:normal; line-height:22px;">
                                    Đơn hàng của bạn đã được thanh toán trực tuyến. Chúng tôi vừa bàn giao đơn đặt
                                    hàng của bạn cho một đối tác vận chuyển.
                                </span>
                            </td>
                            <td class="pl-3" style=" padding-left:10px;">
                                <img src="https://vnpay.vn/wp-content/uploads/2020/07/Logo-VNPAYQR-update.png"
                                    width="130px" style="margin-top: 10px;" alt="">
                            </td>
                            @endif

                        </tr>
                    </table>
                </div>

                <div class="row mt-2" style="margin-top: 15px;">
                    <div class="container-fluid">
                        <div class="row pl-3 py-2" style="background-color: #f4f8fd; padding: 10px 0 10px 20px;">
                            <b>Chi Tiết Đơn Hàng</b>
                        </div>
                        <div class="row pl-3 py-2" style="background-color: #fff; padding: 10px 20px 10px 20px;">
                            <table class="table table-sm table-hover"
                                style="text-align: left;  width: 100%; margin-bottom: 5px; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th style="padding: 5px 0;">Sản phẩm</th>
                                        <th style="padding: 5px 20px 5px 0; text-align: right;">Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total = 0;
                                    @endphp
                                    @foreach ($order->orderDetails as $orderDetail)
                                    <tr>
                                        <td style="border-top: 1px solid #dee2e6; padding: 5px 0;">
                                            {{ $orderDetail->details->product->name . ' (x' . $orderDetail->quantity .
                                            ')' }}
                                            <br>
                                            {{ '(' . $orderDetail->details->size->name . ', ' .
                                            $orderDetail->details->color->name . ')' }}
                                        </td>
                                        <td
                                            style="border-top: 1px solid #dee2e6; padding: 5px 20px 5px 0; text-align: right;">
                                            {{ number_format($orderDetail->price * $orderDetail->quantity) }} VND
                                        </td>

                                        @php
                                        $total += $orderDetail->price * $orderDetail->quantity;
                                        @endphp
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-2" style="margin-top: 15px;">
                    <div class="container-fluid">
                        <div class="row pl-3 py-2" style="background-color: #f4f8fd; padding: 10px 0 10px 20px;">
                            <b>Chi Tiết Thanh Toán</b>
                        </div>
                        <div class="row pl-3 py-2"
                            style="background-color: #fff; font-size: 18px; padding: 2px 20px 10px 20px;">
                            <div class="col-12 p-0">
                                <hr style="border-top: 1px solid #0000001a;">
                                <table class="mt-2 w-100"
                                    style="font-size: 16px; width: 100%; text-align: left;  margin-bottom: 5px;">
                                    @if ($order->voucher_id == null)
                                    <tr style="font-size: 18px;">
                                        <td><b>Tổng</b></td>
                                        <td class="pr-3 text-right" style="text-align: right; padding-right: 20px;">
                                            <b>{{ number_format($total) }} VND</b>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="">Giảm Giá</td>
                                        <td class="pr-3 text-right" style="text-align: right; padding-right: 20px;">
                                            {{ number_format($total * ($order->voucher->discount / 100)) }} VND
                                        </td>
                                    </tr>
                                    <tr style="font-size: 18px;">
                                        <td><b>Tổng</b></td>
                                        <td class="pr-3 text-right" style="text-align: right; padding-right: 20px;">
                                            <b>{{ number_format($total - $total * ($order->voucher->discount / 100)) }}
                                                VND</b>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2 mb-4" style="margin-top: 15px; margin-bottom: 25px;">
                    <div class="container-fluid">
                        <div class="row pl-3 py-2" style="background-color: #f4f8fd; padding: 10px 0 10px 20px;">
                            <b style="color: #00509d; font-size: 18px;">Thông tin khác</b>
                        </div>
                        <div class="row pl-3 py-2" style="background-color: #fff; padding: 10px 20px;">
                            <p>Quý khách có thể kiểm tra hình thức bên ngoài của sản phẩm (nhãn hiệu, model, màu sắc, số
                                lượng,...) trước khi
                                thanh toán và có thể từ chối nhận hàng nếu không hài lòng. Vui lòng quay lại quá trình
                                mở và kiểm tra sản phẩm.</p>

                            <p>Nếu sản phẩm có dấu hiệu hư hỏng/bể vỡ hoặc không đúng với thông tin trên
                                website, vui lòng liên hệ với cửa hàng trong vòng 48h kể từ thời điểm nhận hàng
                                hỗ trợ.</p>

                            <p>Quý khách vui lòng giữ lại hóa đơn, hộp sản phẩm và phiếu bảo hành (nếu có) để đổi trả
                                hoặc bảo hành khi
                                cần thiết.</p>

                            <p>Bạn có thể tham khảo trang Trung tâm trợ giúp hoặc liên hệ với cửa hàng bằng cách để lại
                                lời nhắn tại
                                Trang liên hệ hoặc gửi thư tại đây. Hotline 0 969 688 924 (8:00 - 9:00 cả Thứ 7 và Chủ
                                Nhật).</p>

                            <b>Shop xin cảm ơn!</b>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="container-fluid">
                        <div class="row" style="background-color: #e7eff8; height: 10px;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>