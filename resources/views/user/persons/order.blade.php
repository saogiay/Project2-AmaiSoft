@extends('user.infomation')
@section('infomation')
    <div class="row container-fluid">
        <div class="col-md-12 m-auto mt-5">
            <h1 class="m-5 text-center">Quản lý đơn hàng</h1>
            <table class="table table-hover">
                <thead>
                    <tr class="table-info">
                        <td>Mã hóa đơn</td>
                        <td>Người nhận</td>
                        <td>Địa chỉ</td>
                        <td>Ngày đặt</td>
                        <td>Trạng thái</td>
                        <td>&nbsp;</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <th>{{ $order->id }}</th>
                            <th>{{ $order->name }}</th>
                            <th>{{ $order->address }}</th>
                            <th>{{ $order->created_at }}</th>
                            @if ($order->status == 0)
                                <th><span class="badge badge-primary">Đã đặt hàng</span></th>
                            @endif
                            @if ($order->status == 1)
                                <th><span class="badge badge-warning">Đã giao</span></th>
                            @endif
                            @if ($order->status == 2)
                                <th><span class="badge badge-success">Đã Hủy</span></th>
                            @endif
                            <th>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $order->id }}">
                                    Chi tiết
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr class="table table-info">
                                                                        <th>Ảnh Sản phẩm</th>
                                                                        <th>Tên Sản Phẩm</th>
                                                                        <th>Số lượng</th>
                                                                        <th>Đơn giá</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $total = 0;
                                                                    @endphp
                                                                    @foreach ($order->orderDetails as $orderDetail)
                                                                        <tr>
                                                                            <td>
                                                                                <img style="width: 100px"
                                                                                    src="{{ $orderDetail->details->product->getThumb() }}"
                                                                                    alt="">
                                                                            </td>
                                                                            <td>{{ $orderDetail->details->product->name }}
                                                                            </td>
                                                                            <td>{{ $orderDetail->quantity }}</td>
                                                                            <td>{{ number_format($orderDetail->price) }}
                                                                                VND
                                                                            </td>
                                                                            @php
                                                                                $total += $orderDetail->price * $orderDetail->quantity;
                                                                            @endphp
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    @if ($order->voucher_id == null)
                                                                        <tr class="table table-primary">
                                                                            <td colspan="3"> Giảm giá</td>
                                                                            <td style="color:red">
                                                                                0 VND
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="table table-success">
                                                                            <td colspan="3"> Tổng tiền</td>
                                                                            <td>{{ number_format($total) }} VND</td>
                                                                        </tr>
                                                                    @else
                                                                        <tr class="table table-primary">
                                                                            <td colspan="3"> Giảm giá</td>
                                                                            <td style="color:red">
                                                                                {{ number_format($total * ($order->voucher->discount / 100)) }}
                                                                                VND
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="table table-success">
                                                                            <td colspan="3"> Tổng tiền</td>
                                                                            <td>{{ number_format($total - $total * ($order->voucher->discount / 100)) }}
                                                                                VND</td>
                                                                        </tr>
                                                                    @endif

                                                                    <tr class="table table-secondary">
                                                                        <td colspan="2"> Phương thức thanh toán</td>
                                                                        @if ($order->payment == "COD")
                                                                            <td colspan="2" class="text-end">COD</td>
                                                                        @else
                                                                            <td colspan="2" class="text-end">banking</td>
                                                                        @endif
                                                                    </tr>
                                                                    <tr class="table table-light">
                                                                        <td colspan="2"> Trạng thái</td>
                                                                        @if ($order->status == 0)
                                                                            <td><span class="badge badge-primary">Đã đặt
                                                                                    hàng</span></td>
                                                                        @endif
                                                                        @if ($order->status == 1)
                                                                            <td><span class="badge badge-warning">Đã giao</span></td>
                                                                        @endif
                                                                        @if ($order->status == 2)
                                                                            <td><span class="badge badge-success">Đã hủy</span></td>
                                                                        @endif
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $orders->links() !!}
        </div>
    </div>
@endsection
