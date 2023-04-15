@extends('user.infomation')
@section('infomation')
<div class="row">
    <div class="col-md-12 m-auto mt-5">
        @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
        @endif
        <div class="container pt-5">
            @if ($message = Session::get('message'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>
        @error('new_confirm_password')
        <div class="alert alert-info alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        
        <h1 class="m-5 text-center">Thông tin tài khoản</h1>
        <div class="col-md-10 m-auto">
            <div class="mb-3 d-flex align-items-center">
                <label for="" class="col-3">Email</label>
                <input type="text" class="form-control col-7" readonly value="{{ $user->email }}">
            </div>
            <div class="mb-3 d-flex align-items-center">
                <label for="" class="col-3">Địa chỉ</label>
                <input type="text" class="form-control col-7" readonly value="{{ $user->address }}"
                    placeholder="Nhập địa chỉ">
                <div class="col-md-1">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('updateAddress') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Cập nhật địa chỉ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="" class="col-4">Tỉnh/Thành phố</label>
                                                <select name="city" class="form-control form-select-sm mb-3" id="city"
                                                    aria-label=".form-select-sm">
                                                    <option value="" selected>Chọn tỉnh thành</option>
                                                </select>
                                                @error('name')
                                                <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="" class="col-4">Quận/Huyện</label>
                                                <select name="district" class="form-control form-select-sm mb-3"
                                                    id="district" aria-label=".form-select-sm">
                                                    <option value="123" selected>Chọn quận huyện</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="" class="col-4">Xã/Phường</label>
                                                <select name="ward" class="form-control form-select-sm" id="ward"
                                                    aria-label=".form-select-sm">
                                                    <option value="" selected>Chọn phường xã</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="" class="col-4">Số nhà</label>
                                                <input type="text" class="form-control" name="number"
                                                    placeholder="Số nhà">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <form action="{{ route('updateUser') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3 d-flex align-items-center">
                    <label for="" class="col-3">Họ tên</label>
                    <input name="name" type="text" class="form-control col-7" value="{{ $user->name }}"
                        placeholder="Nhập họ và tên">
                    @error('name')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <label for="" class="col-3">Số điện thoại</label>
                    <input name="phone" type="text" class="form-control col-7" value="{{ $user->phone }}"
                        placeholder="Nhập số điện thoại">
                    @error('phone')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <label for="" class="col-3">Đăng ký nhận khuyến mãi</label>
                    <div class="col-9 d-flex justify-content-evenly">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="registered_pro" id="exampleRadios1"
                                value="1" {{ $user->registered_pro = 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                Có
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="registered_pro" id="exampleRadios2"
                                value="0" {{ $user->registered_pro = 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios2">
                                Không
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success ms-auto">
                    <i class="fa-solid fa-user-pen"></i>
                    Cập nhật
                </button>
            </form>

            <div class="mb-3">
                <!-- Button trigger modal CHANGE PASSWORD-->
                <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Đổi mật khẩu.
                </button>
 
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cập nhật mật khẩu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formPasswd" action="{{ route('update_password') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <input type="password" name="old_password" class="form-control"
                                            id="old_password" placeholder="Mật khẩu hiện tại">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="new_password" class="form-control"
                                            id="new_password" placeholder="Mật khẩu mới">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="new_confirm_password" class="form-control"
                                            id="new_confirm_password" placeholder="Nhập lại mật khẩu">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" form="formPasswd" class="btn btn-primary">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Name);
            }
            citis.onchange = function() {
                district.length = 1;
                ward.length = 1;
                if (this.value != "") {
                    const result = data.filter(n => n.Name === this.value);

                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Name);

                    }
                }
            };
            district.onchange = function() {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Name === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Name);
                    }
                }
            };
        }
</script>
@endsection