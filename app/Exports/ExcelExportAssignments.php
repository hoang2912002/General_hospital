<?php

namespace App\Exports;

use App\Models\ManagementModel\AssignmentModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExportAssignments implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AssignmentModel::all();
    }
}
