<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'equipment_categories';
    protected $fillable = [
        'name', 'slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function medical_equipments(){
        return $this->hasMany(MedicalEquipmentModel::class,'equipment_category_id','id');
    }
}
