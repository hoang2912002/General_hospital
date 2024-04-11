<?php

namespace App\Exports;

use App\Models\ManagementModel\MedicineModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExportMedicines implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MedicineModel::all();
    }
}
