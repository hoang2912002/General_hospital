<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineTypeModel extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = [
        'name','slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function medicines() {
        return $this->hasMany(MedicineModel::class,'type_id','id');
    }
}
