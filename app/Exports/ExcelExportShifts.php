<?php

namespace App\Exports;

use App\Models\ManagementModel\ShiftModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExportShifts implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ShiftModel::query()->select(
            'id',
            'name',
        )->get();
    }
    public function headings() : array
    {
        return [
            '#',
            'Tên ca',
        ];
    }
}
