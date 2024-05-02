<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number_medicalRecordModel extends Model
{
    use HasFactory;
    protected $table = 'number_medical_records';
    protected $fillable = [
        'number_id','patient_uuid','medical_record_id'
    ];

    public function number(){
        return $this->hasOne(NumberModel::class,'id','number_id');
    }
    public function patient(){
        return $this->hasOne(UserModel::class,'uuid','patient_uuid');
    }
    public function medical_record(){
        return $this->hasOne(MedicalRecordModel::class,'id','medical_record_id');
    }
}
