<?php

namespace App\Imports;

use App\Models\ManagementModel\ShiftModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
class ExcelImportShifts implements ToModel,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {


        $shifts = ShiftModel::pluck('slug')->toArray();
        if(!in_array(Str::slug($row['ca']), $shifts)){
            ShiftModel::create([
                //dd($row),
                'name' => $row['ca'],
                'slug' => Str::slug($row['ca'])
            ]);
        }
    }
    public function headingRow(): int
    {
        return 1;
    }
}
