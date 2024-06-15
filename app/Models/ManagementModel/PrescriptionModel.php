<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionModel extends Model
{
    use HasFactory;
    protected $table = 'prescriptions';
    protected $fillable = [
        'medical_record_id','total_price','note'
    ];

    public function medical_record(){
        return $this->hasOne(MedicalRecordModel::class,'id','medical_record_id');
    }

    public function prescription_detail(){
        return $this->hasMany(PrescriptionDetailModel::class,'prescription_id','id');
    }
    public function price()
    {
        $price = number_format($this->total_price,'0',".",".") . 'VNĐ';
        return  $price ;
    }

}
