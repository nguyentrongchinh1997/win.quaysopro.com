<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\CustomerV2;

class CustomerV2Import implements ToCollection, WithHeadingRow
{
    
    public function collection(Collection $rows)
    {
        CustomerV2::where('id', '>', 0)->delete();
        $data = [];
        foreach ($rows as $rowItem) {
            if ($rowItem['code'] != '') {
                $data[] = [
                    'code' => trim($rowItem['code']),
                    'name' => $rowItem['name'],
                    'phone' => $rowItem['phone'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s') 
                ];
            }
        }
        if (count($data) > 0) {
            CustomerV2::insert($data);
        }
    }
    
    public function headingRow(): int
    {
        return 1;
    }
}