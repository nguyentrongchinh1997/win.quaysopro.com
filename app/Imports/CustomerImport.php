<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Customer;

class CustomerImport implements ToCollection, WithHeadingRow
{
    
    public function collection(Collection $rows)
    {
        $data = [];
        foreach ($rows as $rowItem) {
            if ($rowItem['ma_so_du_thuong'] != '') {
                $data[] = [
                    'code' => trim($rowItem['ma_so_du_thuong']),
                    'name' => $rowItem['ten_khach'],
                    'address' => $rowItem['dia_chi'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s') 
                ];
            }
        }
        if (count($data) > 0) {
            Customer::insert($data);
        }
    }
    
    public function headingRow(): int
    {
        return 1;
    }
}