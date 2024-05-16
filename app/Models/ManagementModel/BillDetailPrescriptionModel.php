<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetailPrescriptionModel extends Model
{
    use HasFactory;
    protected $table = 'bill_details_prescription';
    protected $fillable = [
        'bill_id','prescription_id','price'
    ];

    public function bill(){
        return $this->hasOne(BillModel::class,'id','bill_id');
    }
    public function prescription(){
        return $this->hasOne(PrescriptionModel::class,'id','prescription_id');
    }
}
