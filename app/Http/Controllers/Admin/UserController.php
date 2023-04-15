<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('admin.users.index', [
            'title' => 'Người dùng',
            'users' => User::paginate(10)
        ]);
    }

    public function changeStatus(Request $request)
    {
        $this->userService->changeStatus($request);
        return response()->json(
            [
                'message' => 'Cập nhật trạng thái thành công'
            ]
        );
    }
}
