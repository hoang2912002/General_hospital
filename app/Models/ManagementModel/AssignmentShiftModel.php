<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentShiftModel extends Model
{
    use HasFactory;
    protected $table = 'assignment_shifts';
    protected $fillable = ['assignment_id','shift_id'];
    public function assignment(){
        return $this->hasOne(AssignmentModel::class,'id','assignment_id');
    }
    public function assignment_room(){
        return $this->hasMany(AssignmentRoomModel::class,'assignment_shift_id','id');
    }

    public function shift_name(){
        return $this->hasOne(ShiftModel::class,'id','shift_id');
    }

    public function shift(){
        switch ($this->shift_id) {
            case 1:
                return [
                    'start_time' => '06:00:00',
                    'end_time' => '11:30:00'
                ];
                break;
            case 2:
                return [
                    'start_time' => '13:00:00',
                    'end_time' => '16:30:00'
                ];
                break;
            case 3:
                return [
                    'start_time' => '21:00:00',
                    'end_time' => '05:30:00'
                ];
                break;
            default:
                return [
                    'start_time' => '06:00:00',
                    'end_time' => '11:30:00'
                ];
                break;
        }
    }
    //import pdf

}
