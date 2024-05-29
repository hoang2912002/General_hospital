<?php

namespace App\Imports;

use App\Models\ManagementModel\RoomModel;
use App\Models\ManagementModel\ServiceModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class ExcelImportServices implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);

        $room_id = RoomModel::where('slug',Str::slug($row['ten_phong']))->value('id');
        $price = (isset($row['gia'])) ? (float)$row['gia'] : null ;
        $service = ServiceModel::pluck('slug')->toArray();
        if(!in_array(Str::slug($row['dich_vu']), $service)){
            ServiceModel::create([
                'name' => $row['dich_vu'],
                'slug' => Str::slug($row['dich_vu']),
                'price' => $price,
                'room_id' => $room_id,
            ]);
        }
    }
    public function headingRow(): int
    {
        return 1;
    }
}
