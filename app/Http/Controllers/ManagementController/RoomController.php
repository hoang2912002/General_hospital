<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\RoomRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\RoomRequest\UpdateRequest;
use App\Models\ManagementModel\RoomModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name_page = [
            'name' => 'Room Index',
            'total' => 'Room',
            'route' => 'room.index'
        ];

        if($request->ajax()){

            $rooms = RoomModel::get();

            return DataTables::of($rooms)
            ->editColumn('id', function ($room) {
                return '<p class="text-dark  mb-0 font-weight-400">'.$room->id.'</span>';
            })
            ->editColumn('name', function ($room) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$room->name.'</span>';;
            })
            ->editColumn('slug', function ($room) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$room->slug.'</span>';;
            })

            ->addColumn('action', function ($room) {
                $routeDestroy = "'" . route('room.destroy',$room->slug) . "'";
                $route_edit =  '<a href="'. route('room.edit', $room->slug) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit .  '&nbsp'  . $route_delete;
            })

            ->rawColumns(['id','name','slug','action'])
            ->make();
        }
        return view('management.room.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $name_page = [
            'name' => 'Room Create',
            'total' => 'Room',
            'route' => 'room.index'
        ];
        return view('management.room.create',compact('name_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //dd($request);
        try {
            $room = RoomModel::create($request->all());
            if(!empty($room)){
                return redirect()->route('room.index')->with('success','Thêm phòng mới thành công!');
            }
            else{
                return back()->with('error','Thêm phòng thất bại!');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomModel $roomModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomModel $roomModel)
    {
        $name_page = [
            'name' => 'Room Update',
            'total' => 'Room',
            'route' => 'room.index'
        ];
        return view('management.room.update',compact('roomModel','name_page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, RoomModel $roomModel)
    {
        try {
            $room = $roomModel->update($request->all());
            if(!empty($room)){
                return redirect()->route('room.index')->with('success','Cập nhật phòng ' . $request->name . ' thành công!');
            }
            else{
                return back()->with('error','Cập nhật thông tin phòng thất bại!');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomModel $roomModel)
    {
        try {
            if($roomModel->delete()){
                return 1;
            }
            else{
                return 0;
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
