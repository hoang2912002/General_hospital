<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\NumberModel;
use App\Models\ManagementModel\RoomModel;
use PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
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
        $pdf = FacadePdf::loadview('management.number.print_number_file_pdf',compact('print_number'))->setPaper('A4');
        //dd($pdf);
        return $pdf->download('so-thu-tu-' . $print_number->number . '-phong-' . $print_number->room->name . '.pdf');

    }
    public function create_waiting_patient(Request $request)
    {
        $check_number = NumberModel::where('room_id',$request->room_id);
        $number = (!empty($check_number->get()->all())) ? $check_number->get()->last()->number + 1 : 1;
        //dd($number);
        $number_arr =[
            'number' =>  $number,
            'room_id' => $request->room_id,
            'status' => 1,
        ];
        $number_created = NumberModel::create($number_arr);
        //dd('1',$number_created);
        $pdfRoute = route('number.print_number', ['numberModel' => $number_created->id]);
        return response()->json(['success' => true, 'pdfRoute' => $pdfRoute]);
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
