@extends('admin.main')
@section('link')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 text-center">
                    <h1>{{ $title }}</h1>
                </div>
                <div class="col-md-10 m-auto">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên nhãn hàng</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Cập nhật lúc</th>
                                <th class="text-right">
                                    <a href="{{ route('admin.brands.create') }}">
                                        <button class="btn btn-outline-primary">
                                            <i class="fas fa-plus"></i>
                                            Thêm nhãn hàng
                                        </button>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>
                                        {{ $brand['id'] }}
                                    </td>
                                    <td>
                                        {{ $brand['name'] }}
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" @checked($brand['status'])
                                            data-id="{{ $brand['id'] }}">
                                        </div>
                                    </td>
                                    <td>
                                        {{ $brand['created_at'] }}
                                    </td>
                                    <td>
                                        {{ $brand['updated_at'] }}
                                    </td>
                                    <td class="text-right">
                                        <form class="d-inline" action="{{ route('admin.brands.destroy', $brand['id']) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa nhãn hàng?')"> 
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $brands->links() }}
                </div>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $('.form-check-input').change(function() {
        brand_id = $(this).data("id");
        checked = $(this).is(":checked");
        $.ajax({
            url: "{{ route('admin.brands.change_status') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                brand_id: brand_id,
                status : checked ? '1' : '0' ,
            },
            success: function(data) {
                alert(data.message);
            }
        });
    });
</script>
@endsection
