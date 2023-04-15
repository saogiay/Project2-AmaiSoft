@extends('admin.main')
@section('link')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
@section('content')
<div class="container pt-5">
    <div class="row">
        <div class="col-lg-4 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ count($orders) }}</h3>
                    <p>Tổng đơn hàng</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-4 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $revenue }} VND</h3>
                    <p> Tổng doanh thu </p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-4 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ count($users) }}</h3>
                    <p>Số người dùng</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection