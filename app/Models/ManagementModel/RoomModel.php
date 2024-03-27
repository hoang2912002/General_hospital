<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'name','slug','file_type','department_id'
    ];
    public function getRouteKeyName(){
        return 'slug';
    }
}
