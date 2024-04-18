<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDetailModel extends Model
{
    use HasFactory;
    protected $table = 'prescription_details';
    protected $fillable = [
        'medicine_id','prescription_id','quantity','price','note'
    ];

    public function medicine(){
        return $this->hasOne(MedicineModel::class,'id','medicine_id');
    }

    public function prescription_detail(){
        return $this->hasOne(PrescriptionModel::class,'id','prescription_id');
    }
}
