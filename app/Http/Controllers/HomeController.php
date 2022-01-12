<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomerImport;
use App\Imports\CustomerV2Import;
use App\Models\Customer;
use App\Models\CustomerV2;
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

    // quay số phúc lộc thọ
    public function plt(Request $request)
    {
        $type = NULL;

        // if ($request->excel_file) {
        //     dd($request->all());
        //     $type = 'action';
        // }

        return view('pages.plt', compact('type'));
    }

    public function importPlt(Request $request)
    {
        $type = 'active';
        Excel::import(new CustomerV2Import(), $request->file('excel_file'));

        return view('pages.plt_v2', compact('type'));
    }

    public function spin(Request $request)
    {
        try {
            $customers = CustomerV2::inRandomOrder()->where('status', 0)->take(10)->get();

            if (count($customers) > 0) {
                foreach ($customers as $key => $item) {
                    for ($i = 0; $i < 10; $i++) { 
                        $random_list['stt' . $key][] = $this->generate_random_string(7);
                    }
                    $random_list['stt' . $key][] = $item->code;
                    $winner['stt' . $key] = $item->name . ' - ' . substr($item->phone, 0, 7) . '***';
                    $winner_chars['stt' . $key]['char'] = str_split($item->code);
                }
                CustomerV2::whereIn('code', $customers->pluck('code'))->update(['status' => 1]);
                $data = [
                    'status' => true,
                    'win_name' => $winner,
                    'win_chars' => $winner_chars,
                    'list' => $random_list,
                    'count' => count($customers)
                ];
    
                return response()->json($data);
            } else {
                return response()->json(['status' => false, 'message' => 'Danh sách đã hết']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Vui lòng thử lại']);
        }
        
    }

    public function generate_random_string($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function plt2()
    {
        return view('pages.plt_v2');
    }
}
