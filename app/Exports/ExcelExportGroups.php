<?php

namespace App\Exports;

use App\Models\ManagementModel\GroupModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExportGroups implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GroupModel::all();
    }
}
