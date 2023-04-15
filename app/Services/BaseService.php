<?php

namespace App\Services;

abstract class BaseService
{
    protected $model;

    //gán con trỏ tới model trong service được kế thừa
    public function __construct()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    //tạo 1 hàm trừu tượng
    abstract public function getModel();

    //lấy tất cả các dữ liệu từ modal
    public function all()
    {
        return $this->model->all();
    }

    //tìm 1 cột theo id
    public function find($id)
    {
        return $this->model->find($id);
    }

    //thêm data vào model
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    //cập nhập data theo id
    public function update(array $data,$id)
    {
        return $this->model->where('id',$id)->update($data);
    }

    //xóa data theo id
    public function delete($id)
    {
        return $this->model->where('id',$id)->delete();
    }
}
