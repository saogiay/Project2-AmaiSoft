<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Http\Request;

class MainController extends Controller
{   
    private $orderService;
    private $userService;
    private $productService;

    public function __construct(OrderService $orderService, UserService $userService, ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
        $this->productService = $productService;
    }



    // Trang chủ admin
    public function index()
    {
        return view('admin.home', [
            'title' => 'Admin',
            'orders' => $this->orderService->getAll(),
            'revenue' => $this->orderService->getRevenue(),
            'users' => $this->userService->getCountUsers(),
        ]);
    }
}
