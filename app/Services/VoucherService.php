<?php


namespace App\Services;

use App\Jobs\SendVoucherJob;
use App\Models\Voucher;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class VoucherService extends BaseService
{
    protected $data = [];
    public function getModel()
    {
        return Voucher::class;
    }
    //lay danh sach cac vouchers
    public function getAll()
    {
        return Voucher::orderby('id')->simplepaginate(10);
    }
    //lay thong tin admin them 
    public function getData($data)
    {
        $this->data = $data;
        $data['admin_created'] = $data['admin_updated'] = auth()->user()->id;
        return ($data);
    }

    public function getAvailCustomers($request)
    {
        if ($request->allow_multi == 0) {
            return User::whereNotExists(function ($query) {
                $query->select('*')
                    ->from('user_voucher')
                    ->whereRaw('user_id = users.id and voucher_id = ' . $GLOBALS['request']->voucher_id);
            })
                ->where('registered_pro', '1')
                ->get();
        }
        return User::where('registered_pro', '1')->get();
    }

    /**
     *Gửi mã voucher cho khách hàng 
     *   @param $vocher_id id của mã voucher muốn tặng
     *   @param $customer danh sách khách hàng được tặng
     */
    public function giveVoucher($voucher_id, $customers_id)
    {
        $voucher = Voucher::find($voucher_id);
        foreach ($customers_id as $customer_id) {
            $hasCustomer = $voucher->users()->where('user_id', $customer_id)->first();
            if ($hasCustomer) {
                $voucher->users()->updateExistingPivot($customer_id, ['quantity' => $hasCustomer->pivot->quantity + 1]);
            } else {
                $voucher->users()->attach($customer_id, [
                    'quantity' => 1,
                    'admin_created' => auth()->user()->id,
                    'admin_updated' => auth()->user()->id,
                ]);
            }
        }
        SendVoucherJob::dispatch($voucher, $customers_id);

        return $message = "Tặng voucher thành công!";
    }

    public function getCussReceivedVoucher($voucher_id)
    {
        return DB::table('users')
            ->join('user_voucher', 'users.id', '=', 'user_voucher.user_id')
            ->where('voucher_id', $voucher_id)
            ->select('users.*', 'user_voucher.quantity')
            ->get();
    }

    public function getOwnVoucher()
    {
        // return Voucher::whereHas('users', function ($query) {
        //     $query->where('user_id', 1);
        // })->get();
        return DB::table('vouchers')
            ->join('user_voucher', 'vouchers.id', '=', 'user_voucher.voucher_id')
            ->where('user_id', auth()->user()->id)
            ->select('*')
            ->get();
    }
}
