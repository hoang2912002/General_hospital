<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturerModel extends Model
{
    use HasFactory;
    protected $table = "manufacturers";
    protected $fillable = [
        'name','address','email','phone_number'
    ];

    public function medicines(){
        return $this->hasMany(MedicineModel::class,'manufacturer_id','id');
    }
}
