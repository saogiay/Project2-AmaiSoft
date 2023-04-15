<?php

namespace App\Services;

use App\Jobs\SendVerifyEmailJob;
use App\Mail\ForgetPassword;
use App\Mail\VerifyAccount;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    // Xác thực người dùng
    public function authenticate($request): bool
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }

    // Cập nhật mật khẩu
    public function updatePassword($request)
    {
        $request->validate([
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|min:3|max:255',
            'new_confirm_password' => 'required|string|min:3|max:255|same:new_password',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return $message = 'Mật khẩu cũ không chính xác';
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return $message = 'Đổi mật khẩu thành công';
    }

    // Gửi link đặt lại mật khẩu
    public function submitForgetPasswordForm($request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(32);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        SendVerifyEmailJob::dispatch($request->email, new ForgetPassword($token));
    }

    public function checkTokenExists($token)
    {
        return $check = DB::table('password_resets')->where('token', $token)->exists();
    }

    // Đặt lại mật khẩu
    public function submitResetPasswordForm($request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $resetPassword = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        User::where('email', $resetPassword->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where('email', $resetPassword->email)->delete();
    }

    // Đăng ký
    public function register($request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $createUser = User::create($data);

        $token = Str::random(32);

        UserVerify::create([
            'user_id' => $createUser->id,
            'token' => $token
        ]);

        SendVerifyEmailJob::dispatch($request->email, new VerifyAccount($token));
    }

    // Xác thực tài khoản
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Không thể định danh email của bạn !';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->email_verified_at) {
                $verifyUser->user->email_verified_at = Carbon::now();
                $verifyUser->user->save();
                $message = "Xác nhận email thành công, bạn đã có thể đăng nhập.";
            } else {
                $message = "Email đã được xác nhận.";
            }
        }

        return $message;
    }
}
