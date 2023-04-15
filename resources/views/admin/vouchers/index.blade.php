@extends('admin.main')
@section('content')
    <div class="col-md-12">

        <div class="col-md-12 text-center">
            <h1>{{ $title }}</h1>
        </div>
        <div class="col-md-11 m-auto">
            @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif
            <table class="table table-striped table-hover">
                <tr>
                    <th>ID</th>
                    <th>Tên voucher</th>
                    <th>Mã giảm giá</th>
                    <th>Mức giảm</th>
                    <th>Ngày áp dụng</th>
                    <th>Ngày hết hạn</th>
                    <th>Trạng thái</th>
                    <th>Dùng nhiều lần</th>
                    <th class="text-end">
                        <a href="{{route('admin.vouchers.create')}}" class="btn btn-outline-primary">
                            <i class="fa-solid fa-plus"></i>
                            Thêm mã mới
                        </a>
                    </th>
                </tr>
                @foreach ($vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->id }}</td>
                        <td>{{ $voucher->name }}</td>
                        <td>{{ $voucher->code }}</td>
                        <td>{{ $voucher->discount }} % </td>
                        <td>{{ $voucher->start_day }}</td>
                        <td>{{ $voucher->exp }}</td>

                        @if ($voucher->status == 1)
                            <td class="text-primary">Đang kích hoạt</td>
                        @else
                            <td class="text-danger">Vô hiệu hóa</td>
                        @endif
                        @if ($voucher->allow_multi == 1)
                            <td class="text-primary">Có</td>
                        @else
                            <td class="text-danger">Không</td>
                        @endif
                        <td class="text-end">
                            <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" type="button" class="btn btn-info">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <form class="d-inline" action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa mã giảm giá?')"> 
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                            <a href="{{ route('admin.vouchers.show', $voucher->id) }}" type="button"
                                class="btn btn-success">
                                <i class="fa-solid fa-gift"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>


        </div>
    </div>
@endsection
