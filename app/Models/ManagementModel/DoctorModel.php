<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorModel extends Model
{
    use HasFactory;
    protected $table = 'staffs_information';
    protected $fillable = [
        'staff_uuid', 'image','description'
    ];
}
