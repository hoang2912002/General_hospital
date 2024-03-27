<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $fillable = [
        'name','slug'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
