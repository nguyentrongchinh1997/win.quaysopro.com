<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomerImport;
use App\Models\Customer;
use DB;
use Reflector;

class HomeController extends Controller
{
    public function home()
    {
        $customers = Customer::select('name', 'code', 'address')->where('is_show', 1)->latest('updated_at')->get();
        $data = [
            'customers' => $customers
        ];

        return view('pages.home', $data);
    }

    public function getNumber()
    {
        $numbers = Customer::where('is_show', 1)->latest('updated_at')->get();

        return response()->json($numbers);
    }

    public function reset()
    {
        Customer::where('id', '>', 0)->update(['is_show' => 0]);

        return back()->with('success', 'Reset thành công');
    }

    public function remove()
    {
        Customer::where('id', '>', 0)->delete();

        return back()->with('success', 'Xóa thành công');
    }

    public function importForm()
    {
        $numbers = Customer::where('is_show', 1)->latest('updated_at')->get();
        $customers = Customer::all();

        return view('pages.import', compact('numbers', 'customers'));
    }

    public function updateCode(Request $request)
    {
        $code = Customer::where('code', $request->code)->first();

        if (empty($code)) {
            return back()->with('error', 'Số này không ai mua');
        } else {
            Customer::where('code', $request->code)->update(['is_show' => 1]);

            return back()->with('success', 'Cập nhật thành công');
        }
    }

    public function import(Request $request)
    {
        $this->validate($request,
            [
                'file' => 'required|mimes:xlsx'
            ],[
                'file.mimes' => 'File phải là Excel',
                'file.required' => 'Cần chọn file import'
            ]
        );
        try {
            DB::beginTransaction();
            if (!empty($request->remove)) {
                Customer::where('id', '>', 0)->delete();
            }
            Excel::import(new CustomerImport(), $request->file('file'));
            DB::commit();

            return back()->with('success', 'Import thành công');
        } catch (\Throwable $th) {
            DB::rollback();

            return back()->with('error', 'Vui lòng thử lại');
        }
    }

    public function background(Request $request)
    {
        $this->validate($request,
            [
                'background' => 'required|mimes:jpg'
            ],[
                'background.mimes' => 'Ảnh phải định dạng jpg',
                'background.required' => 'Ảnh là bắt buộc'
            ]
        );
        $inputs = $request->except('_token');
        $inputs['background']->move(public_path('/'), 'bg.jpg');

        return back()->with('success', 'Thay ảnh nền thành công');
    }
}
