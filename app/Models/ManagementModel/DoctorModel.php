<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorModel extends Model
{
    use HasFactory;
    protected $table = 'doctors_information';
    protected $fillable = [
        'doctor_uuid', 'image','description'
    ];
}
