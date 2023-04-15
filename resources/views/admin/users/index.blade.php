@extends('admin.main')
@section('content')
<div class="col-md-12 text-center">
    <h1>Danh sách người dùng</h1>
</div>
<div class="col-md-10 m-auto text-center">
    <table class="table table-hover">
        <tr class="table-info">
            <th>
                ID
            </th>
            <th>
                Tên
            </th>
            <th>
                Số điện thoại
            </th>
            <th>
                Email
            </th>
            <th>
                Địa chỉ
            </th>
            <th>
                Đăng ký nhận mail
            </th>
            <th>
                Trạng thái
            </th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>
                {{ $user->id }}
            </td>
            <td>
                {{ $user->name }}
            </td>
            <td>
                {{ $user->phone }}
            </td>
            <td>
                {{ $user->email }}
            </td>
            <td>
                {{ $user->address ?? 'Chưa cập nhật'}}
            </td>
            <td>
                {{ $user->registered_pro ? 'Có' : 'Không' }}
            </td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" @checked($user->status)
                    data-id="{{ $user->id }}">
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $users->links() !!}
</div>
<script>
    $('.form-check-input').change(function() {
        user_id = $(this).data("id");
        checked = $(this).is(":checked");
        $.ajax({
            url: "{{ route('admin.users.change_status') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                user_id: user_id,
                status : checked ? '1' : '0' ,
            },
            success: function(data) {
                alert(data.message);
            }
        });
    });
</script>
@endsection

@section('link')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection