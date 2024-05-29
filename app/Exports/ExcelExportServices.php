<?php

namespace App\Exports;

use App\Models\ManagementModel\ServiceModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExportServices implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ServiceModel::query()
            ->select(
                'services.name as service_name',
                'rooms.name as room_name',
                'services.price',
            )
            ->join('rooms', 'services.room_id', '=', 'rooms.id')
            ->get();
    }

    /**
    * @return array
    */
    public function headings() : array
    {
        return [
            'Dịch vụ',
            'Phòng',
            'Giá',
        ];
    }
}
