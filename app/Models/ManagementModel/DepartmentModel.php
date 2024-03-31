<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = [
        'name', 'slug'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function room(){
        return $this->hasMany(RoomModel::class,'department_id','id');
    }
}
