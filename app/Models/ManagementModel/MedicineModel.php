<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineModel extends Model
{
    use HasFactory;
    protected $table = "medicines";
    protected $fillable = [
        'name','slug','quantity','price','type_id','manufacturer_id','description','image','imp_date','exp_date'
    ];

    public function medicines_type()
    {
        return $this->hasOne(MedicineTypeModel::class,'id','type_id');
    }
    public function manufacturer()
    {
        return $this->hasOne(ManufacturerModel::class,'id','manufacturer_id');
    }
}
