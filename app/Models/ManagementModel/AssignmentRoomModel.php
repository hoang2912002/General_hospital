<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentRoomModel extends Model
{
    use HasFactory;
    protected $table = 'assignment_rooms';
    protected $fillable = ['assignment_day_id','assignment_shift_id','room_id'];
    public function assignment_day(){
        return $this->hasOne(AssignmentDayModel::class,'id','assignment_day_id');
    }
    public function assignment_shift(){
        return $this->hasOne(AssignmentShiftModel::class,'id','assignment_shift_id');
    }
    public function room(){
        return $this->hasOne(RoomModel::class,'id','room_id');
    }
}
