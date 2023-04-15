@extends('admin.main')
@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.vouchers.index') }}" type="button" class="btn btn-secondary">
        <i class="fa-solid fa-circle-left"></i>
        Quay lại
    </a>
    <div class="col-md-12 text-center">
        <h1>Khách hàng đã nhận mã</h1>
        <button type="button" class="btn btn-success send-voucher" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop" data-id="{{ $voucher->id }}" data-multi="{{ $voucher->allow_multi }}"
            data-status="{{ $voucher->status }}">
            Tặng mã giảm giá
        </button>
        <hr>
    </div>
    @if (count($customers) > 0)
    <div class="col-md-8 m-auto">
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
                    Số lượng:
                </th>
            </tr>
            @foreach ($customers as $customer)
            <tr>
                <td>
                    {{ $customer->id }}
                </td>
                <td>
                    {{ $customer->name }}
                </td>
                <td>
                    {{ $customer->phone }}
                </td>
                <td>
                    {{ $customer->email }}
                </td>
                <td>
                    {{ $customer->quantity }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @else
    <div class="text-center display-4">
        Trống
    </div>
    @endif
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Chọn khách hàng</h5>
            </div>
            <div class="modal-body">
                <form action="" id="users_table" method="POST">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Chọn</th>
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody id="render">
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">Đóng</button>
                <button onclick="send()" type="button" form="users_table" class="btn btn-primary">Tặng</button>
            </div>
        </div>
    </div>
</div>
<script>
    let x;
    $('.send-voucher').click(function() {
        x = $(this).data("id");
        let allow_multi = $(this).data("multi");
        let status = $(this).data("status");
        $.ajax({
            url: "{{ route('admin.get_availabe_recipient') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                allow_multi: allow_multi,
                status : status,
                voucher_id: x
            },
            success: function(data) {
                var str = "";
                if (data.error == false) {
                    for (let i = 0; i < data.customers.length; i++) {
                        str += '<tr><td><div class="form-check">';
                        str +=
                            '<input class="form-check-input" type="checkbox" name="list_check[]" value="' +
                            data.customers[i]['id'] + '">';
                        str += '</div></td>';
                        str += '<td>' + data.customers[i]['name'] + '</td>';
                        str += '<td>' + data.customers[i]['phone'] + '</td>';
                        str += '<td>' + data.customers[i]['email'] + '</td>';
                    }
                } else str = data.message;
                $("#render").html(str);
            }
        });
    });

    function send() {
        var checked = [];
        $("input[type=checkbox]").each(function() {
            var self = $(this);
            if ($(this).is(':checked')) {
                checked.push(self.val());
            }
        });
        $.ajax({
            url: '{{ route('admin.give_voucher') }}',
            type: 'POST',
            data: {
                 _token: "{{ csrf_token() }}",
                voucher_id: x,
                checked: checked
            },
            success: function(rs) {
                alert(rs.message);
                location.reload();
            }
        })
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection
