@extends('admin.main')
@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.categories.index') }}" type="button" class="btn btn-secondary">
            <i class="fa-solid fa-circle-left"></i>
            Quay lại
        </a>
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>{{ $title }}</h1>
            </div>
            <div class="col-md-8 m-auto mt-3">
                @if (session('msg'))
                <div class="alert alert-success text-center">{{ session('msg') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    Thông tin điền vào chưa đúng. Vui lòng nhập lại.
                </div>
            @endif
                <form action= "{{route('admin.categories.update',$category->id)}}" method="POST">
                    @method('PUT')
                    <input type="hidden" name="id" id="" value="{{$category->id}}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên danh mục</label>
                        @error('name')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                        <input type="text" name ="name" class="form-control" id="name" value="{{$category->name}}">
                    </div>
            
                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Danh mục cha</label>
                        @error('parent_id')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                        <select class="form-control"  name = "parent_id" >
                            <option value="0" {{ $category->parent_id == 0? 'selected' : ''}}> Là danh mục cha</option>
                            @foreach ($categories as $categoryParent)
                                <option value="{{$categoryParent->id}}" {{ $category->parent_id == $categoryParent->id? 'selected' : ''}}>{{$categoryParent->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="1" {{ $category->status == 1? 'checked=""' : ''}}>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Kích hoạt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="0" {{ $category->status == 0? 'checked=""' : ''}}>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Vô hiệu hóa
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-file-pen"></i>
                        Cập nhật
                    </button>
                    @csrf 
                </form>
            </div>
        </div>
    </div>
@endsection
