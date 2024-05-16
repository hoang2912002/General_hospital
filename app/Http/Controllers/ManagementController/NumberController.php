<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\NumberRequest\StoreRequest;
use App\Models\ManagementModel\NumberModel;
use App\Models\ManagementModel\RoomModel;
use PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ticket(Request $request){
        $name_page = [
            'name' => 'Danh sách số thứ tự',
            'total' => 'Phòng khám',
            'route' => 'number.index'
        ];

        if($request->ajax()){

            $rooms = RoomModel::get();
            $numbers = NumberModel::get();

            return DataTables::of($rooms)
            ->editColumn('id', function ($room) {
                return '<p class="text-dark  mb-0 font-weight-400">'.$room->id.'</p>';
            })
            ->editColumn('name', function ($room) {

                return '<a href="#" class="text-decoration-none" data-bs-toggle="modal" data-room-slug="'.$room->slug.'" data-bs-target="#modal-waiting-patient"  onclick="handleClick(\''.$room->id.'\')">
                            <p class="text-dark px-3 mb-0 font-weight-bold">'.$room->name.'</p>
                        </a>';

            })

            ->editColumn('department', function ($room) {

                return '<p class="text-dark  mb-0">'.$room->department->name.'</p>';
            })
            ->editColumn('status', function ($room) {
                $room_status = $room->number->count('status');
                $room_n = ($room_status >= 10) ? '<span class="badge badge-danger badge-sm">Quá('. $room_status .') người chờ</span>' : '<span class="badge badge-success badge-sm">Vẫn còn('.$room_status.')</span>';
                return '<p class="text-dark  mb-0 ">'.$room_n.'</span>';
            })
            ->addColumn('action', function ($room) {
                $routeDestroy = "'" . route('room.destroy',$room->slug) . "'";
                $route_edit =  '<a href="'. route('room.edit', $room->slug) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit .  '&nbsp'  . $route_delete;
            })

            ->rawColumns(['id','name','department','status','action'])
            ->make();
        }
        return view('management.number.index',compact('name_page'));
    }

    public function waiting_patient(Request $request, RoomModel $roomModel){
        $name_page = [
            'name' => 'Danh sách số thứ tự',
            'total' => 'Phòng khám',
            'route' => 'number.index'
        ];

        if($request->ajax()){

            $rooms = RoomModel::get();
            $numbers = NumberModel::get();

            return DataTables::of($rooms)
            ->editColumn('id', function ($room) {
                return '<p class="text-dark  mb-0 font-weight-400">'.$room->id.'</p>';
            })
            ->editColumn('name', function ($room) {

                return '<a href="'. route('number.waiting_patient',$room->slug) .'" class=""><p class="text-dark px-3 mb-0 font-weight-bold">'.$room->name.'</p></a>';

            })

            ->editColumn('department', function ($room) {

                return '<p class="text-dark  mb-0">'.$room->department->name.'</p>';
            })
            ->editColumn('status', function ($room) {
                $room_status = $room->number->count('status');
                $room_n = ($room_status >= 10) ? '<span class="badge badge-danger badge-sm">Quá('. $room_status .') người chờ</span>' : '<span class="badge badge-success badge-sm">Vẫn còn('.$room_status.')</span>';
                return '<p class="text-dark  mb-0 ">'.$room_n.'</span>';
            })
            ->addColumn('action', function ($room) {
                $routeDestroy = "'" . route('room.destroy',$room->slug) . "'";
                $route_edit =  '<a href="'. route('room.edit', $room->slug) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit .  '&nbsp'  . $route_delete;
            })

            ->rawColumns(['id','name','department','status','action'])
            ->make();
        }
        return view('management.number.index',compact('name_page'));

    }

    public function render_waiting_patient(Request $request){
        try {
            $waiting_patient_number = NumberModel::where([
                ['room_id',$request->room_id],
                ['status',1]
            ])
            ->with(['room' => function ($query) {
                $query->select('id', 'name');
            }])
            ->with(['room.department' => function ($query) {
                $query->select('id', 'name');
            }])
            ->get();
            //dd($waiting_patient_number);
            if (empty($waiting_patient_number->all())) {
                $room = RoomModel::where('id',$request->room_id)->first();
                $waiting_patient_number = [
                    'department' => $room->department->name,
                    'room' => $room->name,
                    'room_id' => $room->id,
                ];
            }
            return response()->json($waiting_patient_number);



        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }



    public function print_number($number)
    {
        $print_number = NumberModel::where('id',$number)->first();
        //dd($print_number->patient_identification_code,$print_number->room->department->name);
        //return view('management.number.print_number_file_pdf',compact('print_number'));

        //$pdf = new FacadePdf();
        $pdf = FacadePdf::loadview('management.number.print_number_file_pdf',compact('print_number'))->setPaper('A4');
        return $pdf->download('so-thu-tu-' . $print_number->number . '-phong-' . $print_number->room->slug . '.pdf');
        // Session::flash('pdf', 'success');
        // return $pdf->download('so-thu-tu-' . $print_number->number . '-phong-' . $print_number->room->slug . '.pdf');
        // $pdfPath = 'public/pdfs/so-thu-tu-' . $print_number->number . '-phong-' . $print_number->room->name . '.pdf';
        // Storage::put($pdfPath, $pdf->output());
        // $pdfUrl = Storage::url($pdfPath);
        // // if ($pdfUrl) {
        // //     // Xóa file
        // //     Storage::delete($pdfPath);
        // // }
        // return redirect()->route('number.ticket');
        // // $pdfPath = 'public/pdfs/so-thu-tu-' . $print_number->number . '-phong-' . $print_number->room->slug . '.pdf';
        // // // Lưu file PDF vào thư mục storage/app/public/pdfs
        // // Storage::put($pdfPath, $pdf->output());

        // // // Lấy URL của file PDF đã lưu
        // // $pdfUrl = Storage::url($pdfPath);

        // // // Chuyển hướng sau khi tải xong PDF
        // // return response()->download(storage_path($pdfPath))->deleteFileAfterSend(true);

    }
    public function create_waiting_patient(Request $request)
    {
        //dd($request);
        $check_number = NumberModel::where('room_id',$request->room_id);
        $number = (!empty($check_number->get()->all())) ? $check_number->get()->last()->number + 1 : 1;
        $room = RoomModel::where('id',$request->room_id)->first();

        $room['number'] = $number;
        $room['status'] = 1;
        $room['department_name'] = $room->department->name;
        // $number_arr =[
        //     'number' =>  $number,
        //     'room_id' => $request->room_id,
        //     'status' => 1,
        // ];
        // $number_created = NumberModel::create($number_arr);
        // //dd('1',$number_created);
        // $pdfRoute = route('number.print_number', ['numberModel' => $number_created->id]);
        // return response()->json(['success' => true, 'pdfRoute' => $pdfRoute]);
        //dd($number,$room);
        return response()->json(['success' => true,'room' => $room]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            //dd($request->arr['number']);
            $number_create = NumberModel::create([
                'number' =>$request->arr['number'],
                'room_id'=>$request->arr['room_id_tbl_number'],
                'first_name'=>$request->arr['first_name'],
                'last_name'=>$request->arr['last_name'],
                'gender'=>$request->arr['gender'],
                'dob'=>$request->arr['dob'],
                'email'=>$request->arr['email'],
                'phone_number'=>$request->arr['phone_number'],
                'patient_identification_code'=>$request->arr['patient_identification_code'],
                'status' => 1
            ]);
            //dd($number_create);
            if(!empty($number_create)){
                // $pdfRoute = route('number.print_number', ['numberModel' => $number->id]);
                // return redirect()->to($pdfRoute);
                $pdfRoute = route('number.print_number', ['numberModel' => $number_create->id]);
                return response()->json(['success' => true, 'pdfRoute' => $pdfRoute]);
                //return redirect()->route('number.ticket')->with('success' , 'Thêm bệnh nhân mới thành công!');

            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NumberModel $numberModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NumberModel $numberModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NumberModel $numberModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NumberModel $numberModel)
    {
        //
    }
}
