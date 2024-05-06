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
    public function shift_tbl(){
        return $this->hasOne(ShiftModel::class,'id','shift_id');
    }

    public function shift_name(){
        return $this->hasOne(ShiftModel::class,'id','shift_id');
    }

    public function shift(){
        switch ($this->shift_id) {
            case 1:
                return [
                    'start_time' => '06:00:00',
                    'end_time' => '08:00:00'
                ];
                break;
            case 2:
                return [
                    'start_time' => '08:00:00',
                    'end_time' => '10:00:00'
                ];
                break;
            case 3:
                return [
                    'start_time' => '10:00:00',
                    'end_time' => '12:00:00'
                ];
                break;
            case 4:
                return [
                    'start_time' => '12:00:00',
                    'end_time' => '14:00:00'
                ];
                break;
            case 5:
                return [
                    'start_time' => '14:00:00',
                    'end_time' => '16:00:00'
                ];
                break;
            case 6:
                return [
                    'start_time' => '16:00:00',
                    'end_time' => '18:00:00'
                ];
                break;
            case 7:
                return [
                    'start_time' => '18:00:00',
                    'end_time' => '20:00:00'
                ];
                break;
            case 8:
                return [
                    'start_time' => '20:00:00',
                    'end_time' =>  '22:00:00'
                ];
                break;
            case 9:
                return [
                    'start_time' =>  '22:00:00',
                    'end_time' =>'00:00:00'
                ];
                break;
            case 10:
                return [
                    'start_time' => '00:00:00',
                    'end_time' => '02:00:00'
                ];
                break;
            case 11:
                return [
                    'start_time' =>'02:00:00',
                    'end_time' => '04:00:00'
                ];
                break;
            case 12:
                return [
                    'start_time' => '04:00:00',
                    'end_time' => '06:00:00'
                ];
                break;
            default:
                return [
                    'start_time' => '06:00:00',
                    'end_time' => '08:00:00'
                ];
                break;
        }
    }
    //import pdf

}
