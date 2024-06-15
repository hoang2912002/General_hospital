<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\PatientRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\PatientRequest\UpdateRequest;
use App\Http\Requests\ManagementRequest\ServiceResultRequest\StoreRequest as ServiceResultRequestStoreRequest;
use App\Models\ManagementModel\AssignmentDayModel;
use App\Models\ManagementModel\AssignmentModel;
use App\Models\ManagementModel\AssignmentRoomModel;
use App\Models\ManagementModel\AssignmentShiftModel;
use App\Models\ManagementModel\GroupModel;
use App\Models\ManagementModel\GroupUserModel;
use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\MedicalRecordModel;
use App\Models\ManagementModel\Number_medicalRecordModel;
use App\Models\ManagementModel\NumberModel;
use App\Models\ManagementModel\ServiceModel;
use App\Models\ManagementModel\ServiceResultModel;
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class ServiceResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',ServiceResultModel::class);
        $users = UserModel::get();
        $group = Auth::user()->User->group_user;
        $arr_role = ['bac-si','nhan-vien-xet-nghiem','nhan-vien-dich-vu'];
        if(in_array($group[0]->slug,$arr_role)){
            //dd(1);

            $assignment = AssignmentModel::where([
                ['staff_uuid',Auth::user()->User->uuid],
                ['date_end','>=', Carbon::now()],
            ])->first();
            $currentDayOfWeek = Carbon::now()->dayOfWeek;
            $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');
            $currentHour = $currentDateTime->toTimeString();
            //$currentMinute = Carbon::now()->minute;
            $currentHour = $currentDateTime->format('H:i:s');

            // So sánh giờ hiện tại với các giờ trong điều kiện so sánh
            if ($currentHour >= '06:00:00' && $currentHour <= '08:00:00') {
                $shift = 1;
            }
            elseif ($currentHour >= '08:00:00' && $currentHour <= '10:00:00') {
                $shift = 2;
            }
            elseif ($currentHour >= '10:00:00' && $currentHour <= '12:00:00') {
                $shift = 3;
            }
            elseif ($currentHour >= '12:00:00' && $currentHour <= '14:00:00') {
                $shift = 4;
            }
            elseif ($currentHour >= '14:00:00' && $currentHour <= '16:00:00') {
                $shift = 5;
            }
            elseif ($currentHour >= '16:00:00' && $currentHour <= '18:00:00') {
                $shift = 6;
            }
            elseif ($currentHour >= '18:00:00' && $currentHour <= '20:00:00') {
                $shift = 7;
            }
            elseif ($currentHour >= '20:00:00' && $currentHour <= '22:00:00') {
                $shift = 8;
            }
            elseif ($currentHour >= '22:00:00' && $currentHour <= '00:00:00') {
                $shift = 9;
            }
            elseif ($currentHour >= '00:00:00' && $currentHour <= '02:00:00') {
                $shift = 10;
            }
            elseif ($currentHour >= '02:00:00' && $currentHour <= '04:00:00') {
                $shift = 11;
            } else {
                $shift = 12; // Nếu không nằm trong bất kỳ khoảng thời gian nào
            }

            $assignment_day = AssignmentDayModel::where([
                ['assignment_id',$assignment->id],
                ['day_id',$currentDayOfWeek]
            ])->first();
            $assignment_shift = AssignmentShiftModel::where([
                ['assignment_id',$assignment->id],
                ['shift_id',$shift]
            ])->first();
            $assignment_room = AssignmentRoomModel::where([
                ['assignment_day_id',$assignment_day->id ?? ''],
                ['assignment_shift_id',$assignment_shift->id ?? ''],
            ])->first() ;
            $shift_name = $assignment_shift->shift_name ?? '';

        }
        $assignment_room = $assignment_room ?? '';
        $name_page = [
            'name' =>  $assignment_room->room->name ?? 'Trống',
            'total' => 'Phòng khám',
            'route' => 'patient.index'
        ];
        if($request->ajax()){
            //dd($assignment_room->room->number);
            $room_id = $assignment_room->room->id ?? [];
            $numbers = NumberModel::where('room_id', $room_id)->where('status', '=', 2)
            ->get();
            $services = ServiceModel::where('room_id', $room_id)->get()->all();
            $shift_id =  $assignment_shift->shift_id;
            $day_id =  $assignment_day->day_id;
            // Biến $data để lưu trữ dữ liệu cuối cùng cho DataTables
            $data = [];
            if(!empty($services)){
                foreach($services as $service) {
                    $test_requisitions = $service->test_requisition;
                    foreach($test_requisitions as $test_requisition) {
                        $medical_record_id = $test_requisition->medical_record_id;
                        // Nếu medical_Record_id chưa tồn tại trong mảng, tạo một phần tử mới
                        if(!isset($serviceData[$medical_record_id])) {
                            $serviceData[$medical_record_id] = [
                                'disease' => $test_requisition->medical_record->disease,
                                'patient_name' => $test_requisition->medical_record->user->name(),
                                'services' => [], // Mảng để lưu trữ các dịch vụ
                            ];
                        }
                        $check_service_result = ServiceResultModel::where([
                            ['medical_record_id',$medical_record_id],
                            ['shift_id',$shift_id],
                            ['day_id',$day_id],
                            ['service_id',$test_requisition->service->id],
                        ])->first();

                        if(empty($check_service_result)){
                            // Thêm dịch vụ vào mảng dịch vụ của medical_Record_id tương ứng
                            $serviceData[$medical_record_id]['services'][] = $test_requisition->service->name;
                        }
                    }
                }
                if(!empty($serviceData)){
                // Duyệt qua mảng dịch vụ đã nhóm và định dạng dữ liệu cho DataTables
                    foreach($serviceData as $medical_record_id => $recordData) {
                        //dd($recordData['services'] !== [],!empty($recordData['services']));
                        if(!empty($recordData['services']))
                        {
                            $service = ServiceModel::whereIn('name', $recordData['services'])->get()->toArray();
                            $arr_service_id = array_column($service, 'id');
                            $route_create_service_result = '<a href="'. route('service_result.create', [
                                'medical_record_id' => $medical_record_id,
                                'service_id' => implode('-', $arr_service_id),
                                'day_id' => $day_id,
                                'shift_id' => $shift_id,
                            ]) .'" class="badge bg-gradient-success" title="Chi tiết dịch vụ"><i class="fas fa-solid fa-hospital-user"></i></a>';
                            $check = '';
                            //$route_edit =  '<a href="'. route('number.edit', $test_requisition->service->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                            $route_delete = '';
                            $route =   $route_create_service_result   ;
                            $data[] = [
                                'disease' => $recordData['disease'],
                                'patient_name' => $recordData['patient_name'],
                                'service_name' => implode(' ,', $recordData['services']), // Gộp các dịch vụ thành một chuỗi
                                'action' => $route, // Bạn có thể thêm hành động nếu cần
                            ];
                        }

                    }
                }
                else{
                    $data = [];
                }
            }
            return response()->json(['data' => $data]);
        }

        return view('management.service_result.index',compact('name_page','assignment_room','shift_name'));
    }
    public function index_management(Request $request){
        $name_page = [
            'name' =>  'Danh mục',
            'total' => 'Kết quả dịch vụ',
            'route' => 'service_result.index_management'
        ];
        if($request->ajax()){

            $service_results = ServiceResultModel::get();

            return DataTables::of($service_results)
            ->editColumn('id', function ($service_result) {
                return $service_result->id;
            })
            ->editColumn('medical_record_id', function ($service_result) {

                return $service_result->medical_record_id;
            })
            ->editColumn('slug', function ($service_result) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$service_result->slug.'</span>';
            })

            ->addColumn('action', function ($service_result) {
                $routeDestroy = "'" . route('service_result.destroy',$service_result->slug) . "'";
                $route_edit =  '<a href="'. route('service_result.edit', $service_result->slug) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit .  '&nbsp'  . $route_delete;
            })
            ->rawColumns(['id','name','slug','action'])
            ->make();
        }
        return view('management.service_result.index_management',compact('name_page','assignment_room','service_result_name'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($medical_record_id,$service_id,$day_id,$shift_id)
    {
        $this->authorize('create', ServiceResultModel::class);
        //dd($medical_record_id,$service_id,$day_id,$shift_id,is_numeric($day_id));
        if(!empty($medical_record_id) && !empty($shift_id) && !empty($service_id) && is_numeric($day_id)){
            //dd($medical_record_id,$service_id,$day_id,$shift_id);
            $services = explode('-',$service_id);
            //dd($services);
            foreach($services as $service){
                $service_arr[] = ServiceModel::where('id',$service)->first();

                //dd($serviceModel[0]->name);
            }
            //dd($serviceModel);
            $medical_recordModel = MedicalRecordModel::where('id', $medical_record_id)->first();
            $shiftModel = ShiftModel::where('id', $shift_id)->first();
            //dd($shiftModel->name);
            $serviceModel = ServiceModel::where('id', $service_id)->first();
            return view('management.service_result.create',
            compact('medical_recordModel','shiftModel','service_arr','day_id'));
            //dd($medical_recordModel,$serviceModel);
        }
        else{
            return back()->with('error','Thiếu dữ liệu để thêm kết quả dịch vụ!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceResultRequestStoreRequest $request)
    {
        try {
            //dd($request->arr);
            if(!empty($request->arr)){
                foreach($request->arr['service_id_arr'] as $index =>  $service_id){
                    //dd($request->arr['price'][$index]);
                    $price = explode(' VNĐ',$request->arr['price'][$index]);
                    $price = explode('.' , $price[0]);
                    //$price = explode(' ' , $price[1]);
                    //dd($price);
                    $price = implode('',$price);

                    //$arr_price[] = $price;
                    $service_result = ServiceResultModel::create([
                        'medical_record_id' => $request->arr['medical_record_id'],
                        'shift_id' => $request->arr['shift_id'],
                        'day_id' => $request->arr['day_id'],
                        'service_id' => $service_id,
                        'price' => $price,
                        'result_file_path' => $request->arr['image'][$index],
                        'result_file_name' => ' ',
                        'note' => $request->arr['description'][$index],
                    ]);
                    if (!$service_result) {
                        // Nếu lệnh tạo mới không thành công, bạn có thể trả về một phản hồi lỗi
                        return response()->json(['status' => 'error', 'message' => 'Failed to create service result']);
                    }
                }
                return response()->json(['status' => 'success']);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to create service result']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceResultModel $serviceResultModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceResultModel $serviceResultModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceResultModel $serviceResultModel)
    {
        //
    }
    public function save_image(Request $request){
        try {
            if($request->hasFile('file')){
                //dd('1',$request);
                //dd(1);
                $files = $request->file;
                foreach($files as $file){
                    $namefile = $file->getClientOriginalName();
                    $dirFolder = 'img/general_hospital/management/service_image/';
                    $newfile = $dirFolder . Carbon::now()->getTimestampMs() . '-' . $namefile;
                    //dd(1);

                    $user_image[]= $newfile;
                    if(!empty($file)){
                        $file->move($dirFolder, $newfile);
                    }
                }
                //dd($medicine_image);
            }
            return response()->json(['status' => "success",'message' => "Lưu file thành công",'service_result_image' => $newfile,'arr_image' => $user_image]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

    public function delete_imageCreate(Request $request){
        try {
            //dd($request);
            if(!empty($request->filename[0])){
                //dd($request);
                $path = public_path(). '/' .  $request->filename[0];
                if(file_exists($path)){
                    File::delete($path);
                }
            }

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceResultModel $serviceResultModel)
    {
        //
    }
}
