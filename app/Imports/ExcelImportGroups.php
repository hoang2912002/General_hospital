<?php

namespace App\Imports;

use App\Models\ManagementModel\GroupModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ExcelImportGroups implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $groups = GroupModel::pluck('slug')->toArray();
        if(!in_array(Str::slug($row['ten']), $groups)){
            GroupModel::create([
                //dd($row),
                'name' => $row['ten'],
                'slug' => Str::slug($row['ten']),
                'activated' => 1,
            ]);
        }
        //dd($arr,$groups,in_array(Str::slug($row['ten']), $groups));
    }
    public function headingRow(): int
    {
        return 1;
    }
}
