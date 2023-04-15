<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Giao diện đăng nhập
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login')->with('title', 'Đăng nhập');
    }

    /**
     * Xác thực đăng nhập.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        if ($this->authService->authenticate($request)) {
            return redirect()->route('homepage');
        } else return back()->withErrors([
            'email' => 'Sai mật khẩu hoặc tài khoản không tồn tại',
        ]);
    }

    /**
     * Đăng xuất
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }

    /**
     * Form đổi mật khẩu
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('admin.changePassword', [
            'title' => 'Đổi mật khẩu'
        ]);
    }

    /**
     * Cập nhật mật khẩu
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $message = $this->authService->updatePassword($request);
        return redirect()->back()->with('message', $message);
    }

    /**
     * Hiển thị form quên mật khẩu
     *
     * @return \Illuminate\Http\Response
     */
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword')->with('title', 'Quên mật khẩu');
    }

    /**
     * Gửi yêu cầu cấp lại mật khẩu
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $this->authService->submitForgetPasswordForm($request);
        return back()->with('message', 'Vui lòng kiểm tra email để thực hiện đặt lại mật khẩu.');
    }

    /**
     * Hiện form đặt lại mật khẩu
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function showResetPasswordForm($token)
    {
        $checkTokenExists = $this->authService->checkTokenExists($token);
        return view('auth.forgetPasswordLink', [
            'token' => $token,
            'check' => $checkTokenExists,
            'title' => 'Đặt lại mật khẩu'
        ]);
    }

    /**
     * Đặt lại mật khẩu
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitResetPasswordForm(Request $request)
    {
        $this->authService->submitResetPasswordForm($request);
        return redirect()->route('login')->with('message', 'Mật khẩu của bạn đã được thay đổi!');
    }

    /**
     * Hiển thị form đăng ký
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {
        return view('auth.registration', [
            'title' => 'Đăng ký'
        ]);
    }

    /**
     * Đăng ký
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
        $this->authService->register($request);
        return back()->with('message', 'Vui lòng kiểm tra email xác nhận để hoàn tất quá trình đăng ký.');
    }

    public function verifyAccount($token)
    {
        $message = $this->authService->verifyAccount($token);
        return redirect()->route('login')->with('message', $message);
    }
}
