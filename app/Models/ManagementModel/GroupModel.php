<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = [
        'name','slug','activated'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

   

}
