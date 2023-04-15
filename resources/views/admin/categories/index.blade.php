@extends('admin.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 text-center">
                    <h1>{{ $title }}</h1>
                </div>
                <div class="col-md-10 m-auto">
                    @if (session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên danh mục</th>
                                <th>Trạng thái</th>
                                <th>Cập nhật lúc</th>
                                <th class="text-right">
                                    <a href="{{route('admin.categories.create')}}">
                                        <button class="btn btn-outline-info">
                                            <i class="fas fa-plus"></i>
                                            Thêm danh mục
                                        </button>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {!! \App\Helpers\Helper::category($categories) !!}
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
