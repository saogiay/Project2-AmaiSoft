@extends('admin.main')
@section('link')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
@section('content')
    <div class="col-md-12">
        <div class="col-md-12 text-center">
            <h1>{{ $title }}</h1>
        </div>
        <div class="col-md-10 m-auto">
            @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Cập nhật lúc</th>
                        <th>
                            <a class="btn btn-outline-primary" href="{{route('admin.sliders.create')}}">
                                <i class="fa-solid fa-plus"></i>
                                Thêm banner
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                        <tr>
                            <td>
                                {{ $slider->id }}
                            </td>
                            <td style="width: 25%">
                                <img src="/storage/sliders/{{ $slider->url }}" alt="" style="width:100%">
                            </td>
                            <td>
                                {{ $slider->name }}
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" @checked($slider->status)
                                    data-id="{{ $slider->id }}">
                                </div>
                            </td>
                            <td>
                                {{ $slider->created_at }}
                            </td>
                            <td>
                                {{ $slider->updated_at }}
                            </td>
                            <td>
                                <form class="d-inline" action="{{ route('admin.sliders.destroy', $slider->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa banner này?')"> 
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $sliders->links() }}
        </div>
    </div>
@endsection
@section('js')
<script>
    $('.form-check-input').change(function() {
        slider_id = $(this).data("id");
        checked = $(this).is(":checked");
        $.ajax({
            url: "{{ route('admin.sliders.change_status') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                slider_id: slider_id,
                status : checked ? '1' : '0' ,
            },
            success: function(data) {
                alert(data.message);
            }
        });
    });
</script>
@endsection
