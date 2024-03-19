<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftModel extends Model
{
    use HasFactory;
    protected $table = 'shifts';
    protected $fillable = [
        'name','slug'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
