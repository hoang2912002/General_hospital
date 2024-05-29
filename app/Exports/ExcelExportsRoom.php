<?php

namespace App\Exports;

use App\Models\ManagementModel\RoomModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExportsRoom implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RoomModel::query()->select(
            'rooms.id',
            'rooms.name as room_name',
            'departments.name as department_name',
        )->join('departments', 'rooms.department_id', 'departments.id')->get();
    }
    public function headings() : array
    {
        return [
            '#',
            'Tên phòng',
            'Tên khoa',

        ];
    }
}
