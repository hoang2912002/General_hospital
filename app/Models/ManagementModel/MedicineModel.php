<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineModel extends Model
{
    use HasFactory;
    protected $table = "medicines";
    protected $fillable = [
        'name','slug','quantity','price','category_id','manufacturer_id','description','image','imp_date','exp_date'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function medicines_type()
    {
        return $this->hasOne(MedicineTypeModel::class,'id','category_id');
    }
    public function manufacturer()
    {
        return $this->hasOne(ManufacturerModel::class,'id','manufacturer_id');
    }
    public function status(){
        return ($this->quantity <= 0) ? '<span class="badge badge-danger badge-sm">Out of Stock</span>' : '<span class="badge badge-success badge-sm">in Stock</span>';
    }
    public function status_detail(){
        return ($this->quantity <= 0) ? '<span class="badge badge-danger">Out of Stock</span>' : '<span class="badge badge-success">In Stock</span>';
    }
    public function price()
    {
        $price = number_format($this->price,'0',".",".") . ' VNĐ';
        return  $price ;
    }
}
