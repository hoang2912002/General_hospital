<?php

namespace App\Http\Controllers\ManagementController;

use App\Exports\ExcelExportAssignments;
use App\Http\Controllers\Controller;
use App\Imports\ExcelImportAssignments;
use App\Models\ManagementModel\AssignmentDayModel;
use App\Models\ManagementModel\AssignmentModel;
use App\Models\ManagementModel\AssignmentRoomModel;
use App\Models\ManagementModel\AssignmentShiftModel;
use App\Models\ManagementModel\ShiftModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\TextUI\Help;
use Yajra\DataTables\DataTables;


class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name_page = [
            'name' => 'Danh sách',
            'total' => 'Lịch phân công',
            'route' => 'assignment.index'
        ];
        if($request->ajax()){
            //$assignments = AssignmentModel::get();
            $assignments = AssignmentModel::whereDate('date_end', '>=', now())->get();

            return DataTables::of($assignments)
            ->editColumn('id', function ($assignment) {
                return $assignment->id;
            })
            ->editColumn('full_name', function ($assignment) {
                return $assignment->staff->aboard_name();
            })
            ->editColumn('date_start', function ($assignment) {
                return $assignment->date($assignment->date_start);
            })
            ->editColumn('date_end', function ($assignment) {
                return $assignment->date($assignment->date_end);
            })
            ->addColumn('action', function ($assignment) {
                $routeDestroy = "'" . route('assignment.destroy',$assignment->id) . "'";
                $route_edit =  '<a href="'. route('assignment.edit', $assignment->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_detail =  '<a href="#" class="badge bg-gradient-success" data-bs-toggle="modal" data-assignment-id="'.$assignment->id.'"
                data-bs-target="#modal-detail-assignment"  onclick="handleClick(\''.$assignment->id.'\')">
                <i class="fas fa-solid fa-file"></i>
                </a>';
                //$route_detail =  '<a href="'. route('user.detail', $user->uuid) .'" class="badge bg-gradient-success"><i class="fas fa-solid fa-file"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $route_detail . '&nbsp'  . $route_delete;
            })
            ->rawColumns(['id','full_name','date_start','date_end','action'])
            ->make();
        }
        return view('management.assignment.index',compact('name_page'));
    }
    public function import(Request $request)
    {
        if(!empty($request->file('file'))){
            $path = $request->file("file")->getRealPath();
            //dd($path);
            Excel::import(new ExcelImportAssignments, $path);
            return back();
        }
        else{
            return back()->with('error','Vui lòng chọn file excel');
        }
    }
    public function export()
    {
        return Excel::download(new ExcelExportAssignments , 'user-'  . date('s_i_H-Y_m_d') .  '.xlsx');
    }
    public function calender()
    {
        return view('management.assignment.calender');
    }

    public function render_calender(Request $request){
        try {
            if(!empty($request->staff_uuid)){
                $assignment = AssignmentModel::where('staff_uuid',$request->staff_uuid)->first();
                $assignment_day = AssignmentDayModel::where('assignment_id',$assignment->id)->get();

                $assignment_shift = AssignmentShiftModel::where('assignment_id',$assignment->id)->get();
                foreach($assignment_day as $day){
                    foreach($assignment_shift as $shift){
                        $data_time = $shift->shift();
                        //dd($data_time['start_time']);
                        $assignment_room = AssignmentRoomModel::where([
                            ['assignment_day_id',$day->id],
                            ['assignment_shift_id', $shift->id ]
                        ])->first();
                        if(!empty($assignment_room)){
                            //dd($assignment_room,$day->id);
                            $arr_assignment[$day->day_id][$shift->shift_id] = [
                                'shift_name' => $assignment_room->assignment_shift->shift_name->name,
                                'room_id'=>$assignment_room->room_id,
                                'room_name'=>$assignment_room->room->name,
                                'start_time' => $data_time['start_time'] ,
                                'end_time' => $data_time['end_time'],
                            ];
                        }
                    }
                }
                return response()->json(['arr'=> $arr_assignment,'date' => $assignment]);
            }
        } catch (\Throwable $th) {
            return response()->json(['arr'=> null,'date' => null]);
        }

    }
    public function render_calender_detail(Request $request){
        try {
            //dd($request);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
    public function detail(Request $request){
        //dd($request);
        try {
            if(!empty($request->assignment)){
                $assignment = AssignmentModel::where('id',$request->assignment)->first();
            }
            if(!empty($request->staff_uuid)){
                $assignment = AssignmentModel::where([
                    ['staff_uuid',$request->staff_uuid],
                    ['date_end','>=', Carbon::now()],
                ])->first();
            }
            $assignment_shift = AssignmentShiftModel::where('assignment_id',$request->assignment ?? $assignment->id )->get();
            $assignment_day = AssignmentDayModel::where('assignment_id',$request->assignment ?? $assignment->id)->get();
            $shift = ShiftModel::get()->toArray();
            $array_shift =  array_column($shift, null,'id');
            //dd($array_id_prescription_details);
                $arr = [];
                foreach($assignment_day as $day){
                    foreach($assignment_shift as $shift){
                        $assignment_room = AssignmentRoomModel::where([
                            ['assignment_day_id',$day->id],
                            ['assignment_shift_id',$shift->id],
                        ])->first();
                        if(!empty($assignment_room)){
                            $arr[$shift->shift_id][$day->day($day->day_id)] = [
                                'room' => $assignment_room->room->name,
                            ];
                        }
                        $arr_shift[$shift->shift_id]=[
                            'name' => $shift->shift_name->name,
                        ];
                    }
                    $arr_day[$day->day_id]=[
                        'name' => $day->day($day->day_id),
                    ];
                }

                //dd($arr_shift);
                $assignment['date_start'] = $assignment->date($assignment['date_start']);
                $assignment['date_end'] = $assignment->date($assignment['date_end']);
                $assignment['user_name'] = $assignment->staff->first_name . ' '  . $assignment->staff->last_name;
                //dd($assignment);
                //dd($assignment);
                return response()->json(['arr'=> $arr,'date' => $assignment,'arr_shift'=>$array_shift,'arr_day'=>$arr_day]);
                //dd($arr);

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignmentModel $assignmentModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssignmentModel $assignmentModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignmentModel $assignmentModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignmentModel $assignmentModel)
    {
        try {

            //if()
            //dd($assignmentModel->assignment_shift);
            foreach($assignmentModel->assignment_day as $day){
                foreach($assignmentModel->assignment_shift as $shift){
                    $assignment_room = AssignmentRoomModel::where([
                        ['assignment_day_id',$day->id],
                        ['assignment_shift_id',$shift->id],
                    ]);
                    if(!empty($assignment_room->get()->all())){
                        //dd($assignment_room->get());
                        $assignment_room->delete();
                    }
                }
            }
            if(!empty($assignmentModel->assignment_shift()->delete())){
                if(!empty($assignmentModel->assignment_day()->delete())){
                    if(!empty($assignmentModel->delete())){
                        return 1;
                    }
                    else{return 0;}
                }else{return 0;}
            }else{return 0;}
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
