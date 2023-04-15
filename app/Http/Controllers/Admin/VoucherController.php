<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\VoucherService;
use Illuminate\Http\Request;
use App\Http\Requests\VoucherRequest;
use App\Models\User;
use App\Models\Voucher;

class VoucherController extends Controller
{
    protected $voucherService;
    protected $data = [];
    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
    }
    /*
    * Danh sach ma giam gia
    */
    public function index()
    {
        return view('admin.vouchers.index', [
            'title' => 'Danh sách mã giảm giá',
            'vouchers' => $this->voucherService->getAll()
        ]);
    }
    /*
    * Form them ma giam gia moi
    */
    public function create()
    {
        return view('admin.vouchers.add', [
            'title' => 'Thêm mã giảm giá'
        ]);
    }

    /*
    * Xu ly them ma giam gia
    */
    public function store(VoucherRequest $request)
    {
        $data = $request->except('_token');
        $this->data = $this->voucherService->getData($data);
        $this->voucherService->create($this->data);
        return redirect()->route('admin.vouchers.create')->with('msg', 'Thêm mã giảm giá thành công');
    }
    /*
    * form cap nhat ma giam gia
    */
    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', [
            'title' => 'Cập nhật mã giảm giá',
            'voucher' => $voucher
        ]);
    }

    /*
    * Xu ly cap nhat ma giam gia
    */
    public function update(VoucherRequest $request, Voucher $voucher)
    {
        $data = $request->except('_token', '_method');
        $this->data = $this->voucherService->getData($data);
        $this->voucherService->update($this->data, $voucher->id);
        return redirect()->route('admin.vouchers.edit', $voucher->id)->with('msg', 'Thêm mã giảm giá thành công');
    }

    /*
    * Xoa ma giam gia
    */
    public function destroy($id)
    {
        $this->voucherService->delete($id);
        return redirect(route('admin.vouchers.index'))->with('success', 'Xóa mã giảm giá thành công');
    }

    /*
    * Hiển thị, tặng mã giảm giá
    */
    public function show(Voucher $voucher)
    {
        return view('admin.vouchers.show', [
            'title' => 'Tặng mã',
            'voucher' => $voucher,
            'customers' => $this->voucherService->getCussReceivedVoucher($voucher->id)
        ]);
    }

    /**
     * Hiển thị danh sách khách hàng thỏa mãn điều kiện nhận mã voucher
     *  @param $request thông tin voucher
     *  @return  App\Models\Customer danh sách khách hàng có thể nhận mã voucher
     *
     */
    public function getAvailCustomers(Request $request)
    {
        if ($request->status == 0) return response()->json([
            'error' => true,
            'message' => "Voucher chưa được kích hoạt!!",
        ]);
        $customers = $this->voucherService->getAvailCustomers($request);
        if ($customers->isEmpty()) return response()->json([
            'error' => true,
            'message' => "Không tồn tại khách hàng phù hợp",
        ]);
        return response()->json([
            'error' => false,
            'customers' => $customers
        ]);
    }

    /**
     * Gửi tặng voucher cho danh sách khách hàng được chọn
     * @param $request->voucher_id voucher được chọn
     *  @param $request->checked danh sách id khách hàng được tặng voucher
     */
    public function giveVoucher(Request $request)
    {
        $message = $this->voucherService->giveVoucher($request->voucher_id, $request->checked);
        return response()->json([
            'message' => $message,
        ]);
    }
}
