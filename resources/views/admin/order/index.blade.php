@extends('admin.main')
@section('link')
    <script src="/template/js/table2excel.js" type="text/javascript"></script>
@endsection
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="col-md-12 text-center">
            <h1>{{ $title }}</h1>
            <button class="btn btn-outline-success" id="export"><i class="fa-solid fa-file-export"></i> Xuất file</button>
        </div>
        <div class="col-md-11 m-auto">
            @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif
            <table class="table table-striped table-hover" id="dataList">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                    <tr>
                        <th>{{ $order->id }}</th>
                        <th>{{ $order->name }}</th>
                        <th>{{ $order->address }}</th>
                        <th>{{ $order->created_at }}</th>
                        <th>
                            <select class="form-select select_status" aria-label="Default select example" data-id="{{ $order->id }}">
                                <option value="0" {{ $order->status == '0' ? 'selected' : '' }}>Đã đặt hàng</option>
                                <option value="1" {{ $order->status == '1' ? 'selected' : '' }}>Đã giao</option>
                                <option value="2" {{ $order->status == '2' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </th>
                        {{-- @if ($order->status == 0)
                        <th><span class="badge badge-primary">Đã đặt hàng</span></th>
                        @endif
                        @if ($order->status == 1)
                        <th><span class="badge badge-warning">Đang giao hàng</span></th>
                        @endif
                        @if ($order->status == 2)
                        <th><span class="badge badge-success">Đã Giao</span></th>
                        @endif
                        @if ($order->status == 3)
                        <th><span class="badge badge-danger">Đã hủy</span></th>
                        @endif --}}
                        <th>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-link" data-toggle="modal"
                                data-target="#orderModal{{ $order->id }}">
                                Chi tiết
                            </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1"
                                        aria-labelledby="orderModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="orderModalLabel">Chi tiết đơn hàng</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close">x</button>
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
                                                                                        src="{{ $orderDetail->details->product->thumbs[0]->url }}"
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
                                                                    <td><span class="badge badge-warning">Đang giao
                                                                            hàng</span></td>
                                                                    @endif
                                                                    @if ($order->status == 2)
                                                                    <td><span class="badge badge-success">Đã
                                                                            Giao</span></td>
                                                                    @endif
                                                                    @if ($order->status == 3)
                                                                    <td><span class="badge badge-danger">Đã
                                                                            hủy</span></td>
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
                                                data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $( ".select_status" ).change(function() {
        new_status = $(this).val();
        order_id = $(this).data("id");
        $.ajax({
            url: "{{ route('admin.orders.change_status') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                new_status: new_status,
                order_id : order_id ,
            },
            success: function(data) {
                alert(data.message);
            }
        });
    });
    document.getElementById('export').addEventListener('click', function() {
        var table2excel = new Table2Excel();
        table2excel.export(document.querySelectorAll("#dataList"));
    });
</script>
@endsection
