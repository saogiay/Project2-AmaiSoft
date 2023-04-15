<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function changeStatus($request)
    {
        User::find($request->user_id)->update([
            'status' => $request->status
        ]);
    }

    public function getInfoUser()
    {
        return Auth::user();
    }

    public function updateAddress($request)
    {
        $city = $request->city;
        $district =$request->district;
        $ward = $request->ward;
        $number = $request->number;

        $address = '';

        if ($city) {
            $address .= $city . ', ';
        }

        if ($district) {
            $address .= $district . ', ';
        }

        if ($ward) {
            $address .= $ward . ', ';
        }

        if ($number) {
            $address .= $number;
        }

        // Xóa dấu phẩy ở cuối nếu có
        $address = rtrim($address, ', ');

        $user = Auth::user();
        $user->address = $address;
        $user->save();
    }

    public function updateUser($request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->registered_pro = $request->registered_pro;
        $user->save();
    }

    public function getCountUsers()
    {
        return User::where('status', '1')->get();
    }
}
