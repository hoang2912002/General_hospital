<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalEquipmentModel extends Model
{
    use HasFactory;
    protected $table = 'medical_equipments';
    protected $fillable = [
        'name', 'image', 'status', 'equipment_category_id', 'production_date', 'exp_date', 'quantity', 'note'
    ];

    public function equipment_category(){
        return $this->hasOne(EquipmentCategoryModel::class,'id','equipment_category_id');
    }
}
