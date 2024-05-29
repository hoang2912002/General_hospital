<?php

namespace App\Exports;

use App\Models\ManagementModel\MedicineModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExportMedicines implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MedicineModel::query()
            ->select(
                'medicines.name as medicine_name',
                'categories.name as category_name',
                'manufacturers.name as manufacturer_name',
                'manufacturers.address as manufacturer_address',
                'medicines.price',
                'medicines.quantity',
                'medicines.imp_date',
                'medicines.exp_date'
            )
            ->join('manufacturers', 'medicines.manufacturer_id', '=', 'manufacturers.id')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->get();
    }

    /**
    * @return array
    */
    public function headings() : array
    {
        return [
            'Tên',
            'Loại',
            'Nhà sản xuất',
            'Nước sản xuất',
            'Giá',
            'Số lượng',
            'Ngày nhập',
            'Hạn sử dụng',
        ];
    }
}
