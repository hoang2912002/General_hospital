<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientIdentificationModel extends Model
{
    use HasFactory;
    protected $table = "patients_identification";
    protected $fillable = [
        'patient_uuid', 'patient_identification_code'
    ];
}
