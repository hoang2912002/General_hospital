<?php

namespace App\Imports;

use App\Models\ManagementModel\DepartmentModel;
use App\Models\ManagementModel\RoomModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelImportRooms implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);

        $departments = DepartmentModel::pluck('slug')->toArray();
        $price = (isset($row['gia'])) ? (float)$row['gia'] : null ;
        if(!in_array(Str::slug($row['ten_khoa']), $departments)){
            DepartmentModel::create([
                //dd($row),
                'name' => $row['ten_khoa'],
                'slug' => Str::slug($row['ten_khoa']),
                'price' => $price
            ]);
        }
        $department_id = DepartmentModel::where('slug',Str::slug($row['ten_khoa']))->value('id');
        $rooms = RoomModel::pluck('slug')->toArray();
        if(!in_array(Str::slug($row['ten_phong']), $rooms)){
            RoomModel::create([
                'name' => $row['ten_phong'],
                'slug' => Str::slug($row['ten_phong']),
                'department_id' => $department_id
            ]);
        }
    }
    public function headingRow(): int
    {
        return 1;
    }
}
