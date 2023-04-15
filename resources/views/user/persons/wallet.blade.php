@extends('user.infomation')
@section('infomation')
<div class="row">
    <div class="col-md-12 m-auto mt-5">
        <h1 class="m-5 text-center">Ví voucher</h1>
        @if (count($vouchers) > 0)
        <table class="table table-hover">
            <thead>
                <tr class="table table-primary">
                    <th>
                        STT
                    </th>
                    <th>
                        Tên voucher
                    </th>
                    <th>
                        Mã voucher
                    </th>
                    <th>
                        Mức giảm
                    </th>
                    <th>
                        Ngày áp dụng
                    </th>
                    <th>
                        Ngày hết hạn
                    </th>
                    <th>
                        Số lượng
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vouchers as $key => $voucher)
                <tr>
                    <td>
                        {{ $key }}
                    </td>
                    <td>
                        {{ $voucher->name }}
                    </td>
                    <td>
                        {{ $voucher->code }}
                    </td>
                    <td>
                        {{ $voucher->discount }}
                    </td>
                    <td>
                        {{ $voucher->start_day }}
                    </td>
                    <td>
                        {{ $voucher->exp }}
                    </td>
                    <td>
                        {{ $voucher->quantity }}
                    </td>
                    @endforeach
            </tbody>
        </table>
        @else
        <div class="col-md-12 my-5 text-center">
            <h2>Không có sản phẩm nào</h2>
        </div>
        @endif
    </div>
</div>
@endsection