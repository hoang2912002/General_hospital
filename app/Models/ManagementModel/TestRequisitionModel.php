<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestRequisitionModel extends Model
{
    use HasFactory;
    protected $table = 'test_requisitions';
    protected $fillable = [
        'service_id', 'medical_record_id', 'status'
    ];
    public function service(){
        return $this->hasOne(ServiceModel::class,'id','service_id');
    }
    public function medical_record(){
        return $this->hasOne(MedicalRecordModel::class,'id','medical_record_id');
    }
}
