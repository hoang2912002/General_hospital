<?php

namespace App\Exports;

use App\Models\ManagementModel\MedicalEquipmentModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExportMedicalEquipments implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MedicalEquipmentModel::query()
            ->select(
                'medical_equipments.series as medical_equipment_series',
                'medical_equipments.name as medical_equipment_name',
                'equipment_categories.name as equipment_categorie_name',
                'medical_equipments.status as medical_equipment_status',
                'medical_equipments.production_date as medical_equipment_production_date',
                'medical_equipments.exp_date as medical_equipment_exp_date'
            )
            ->join('equipment_categories', 'medical_equipments.equipment_category_id', '=', 'equipment_categories.id')
            ->get();
    }

    /**
    * @return array
    */
    public function headings() : array
    {
        return [
            'Số series',
            'Tên',
            'Loại',
            'Trạng thái',
            'Ngày sản xuất',
            'Hạn sử dụng',
        ];
    }
}
