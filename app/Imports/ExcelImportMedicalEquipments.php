<?php

namespace App\Imports;

use App\Models\ManagementModel\EquipmentCategoryModel;
use App\Models\ManagementModel\MedicalEquipmentModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class ExcelImportMedicalEquipments implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        $production_date = $this->convertDate($row['ngay_san_xuat']);
        $exp_date = $this->convertDate($row['han_su_dung']);
        $equipment_categories = EquipmentCategoryModel::pluck('slug')->toArray();

        if(!in_array(Str::slug($row['loai']), $equipment_categories)){
            EquipmentCategoryModel::create([
                //dd($row),
                'name' => $row['loai'],
                'slug' => Str::slug($row['loai'])
            ]);
        }
        $equipment_category_id = EquipmentCategoryModel::where('slug',Str::slug($row['loai']))->value('id');
        $medical_equipments = MedicalEquipmentModel::pluck('series')->toArray();
        if(!in_array($row['so_series'], $medical_equipments)){
            MedicalEquipmentModel::create([
                'series' => $row['so_series'],
                'name' => $row['ten'],
                'status' => 1,
                'equipment_category_id' => $equipment_category_id,
                'production_date' => $production_date,
                'exp_date' => $exp_date
            ]);
        }
    }

    private function convertDate($date)
    {
        if (is_numeric($date)) {
            $dateTimeObject = Date::excelToDateTimeObject($date);
            return $dateTimeObject->format('Y-m-d');
        } else {
            $dateTimeObject = \DateTime::createFromFormat('d/m/Y', $date);
            if ($dateTimeObject !== false) {
                return $dateTimeObject->format('Y-m-d');
            } else {
                return null; // Hoặc xử lý lỗi theo nhu cầu của bạn
            }
        }
    }
    public function headingRow(): int
    {
        return 1;
    }
}
