<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SliderService;
use App\Services\Views\ProductService;
use Illuminate\Http\Request;

class MainController extends Controller
{   
    protected $sliderService;
    protected $productService;

    public function __construct(SliderService $sliderService, ProductService $productService){
        $this->sliderService = $sliderService;
        $this->productService = $productService;
    }

    // Home page user
    public function index()
    {
        return view('user.home', [
            'title' => 'Trang chủ',
            'sliders' => $this->sliderService->getSliders(),
            'products' => $this->productService->getNewest()
        ]);
    }

    // Introduction website
    public function intro(){
        return view('user.intro',[
            'title' => 'Giới thiệu'
        ]);
    }
    //Contact form 
    public function contact(){
        return view('user.contact',[
            'title' => 'Liên hệ'
        ]);
    }
}
