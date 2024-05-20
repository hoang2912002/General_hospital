<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\EquipmentCategoryModel;
use App\Models\ManagementModel\MedicalEquipmentModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
class MedicalEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',MedicalEquipmentModel::class);
        $name_page = [
            'name' => 'Thư mục',
            'total' => 'Thiết bị y tế',
            'route' => 'medical_equipment.index'
        ];

        if($request->ajax()){

            $medical_equipments = MedicalEquipmentModel::get();
            return DataTables::of($medical_equipments)

            ->editColumn('id', function ($medical_equipment) {
                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->id.'</span>';
            })
            ->editColumn('image', function ($medical_equipment) {
                return '<img class="" style="height:40px" src="' . asset($medical_equipment->image) . '" alt="' . $medical_equipment->name . '">';
            })
            ->editColumn('name', function ($medical_equipment) {

                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->name.'</span>';;
            })
            ->editColumn('status', function ($medical_equipment) {

                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->status.'</span>';;
            })
            ->editColumn('production_date', function ($medical_equipment) {

                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->production_date.'</span>';;
            })
            ->editColumn('exp_date', function ($medical_equipment) {

                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->exp_date.'</span>';;
            })
            ->editColumn('quantity', function ($medical_equipment) {

                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->quantity.'</span>';;
            })

            ->addColumn('action', function ($medical_equipment) {
                $routeDestroy = "'" . route('medical_equipment.destroy',$medical_equipment->id) . "'";
                $route_edit =  '<a href="'. route('medical_equipment.edit', $medical_equipment->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit .  '&nbsp'  . $route_delete;
            })

            ->rawColumns(['checkbox','id','image','name','status','production_date','exp_date','quantity','action'])
            ->make();
        }
        return view('management.medical_equipment.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $name_page = [
            'name' => 'Thêm',
            'total' => 'Thiết bị y tế',
            'route' => 'medical_equipment.index',
        ];
        $equipment_category = EquipmentCategoryModel::get();
        return view('management.medical_equipment.create', compact('name_page', 'equipment_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        try {
            if(!empty($request->arr)){
                $medical_equipment = MedicalEquipmentModel::create([
                    'series' => $request->arr['series'] ,
                    'name' => $request->arr['name'] ,
                    'image' => $request->arr['image'] ,
                    'status' => $request->arr['status'] ,
                    'equipment_category_id' => $request->arr['equipment_category_id'] ,
                    'production_date' => $request->arr['production_date'] ,
                    'exp_date' => $request->arr['exp_date'] ,
                    'quantity' => $request->arr['quantity'] ,
                    'note' => $request->arr['note'] ,
                ]);
                if(!empty($medical_equipment)){
                    $route = route('medical_equipment.index');
                    return response()->json(['success' => true, 'route' => $route]);

                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalEquipmentModel $medicalEquipmentModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalEquipmentModel $medicalEquipmentModel)
    {
        //dd($medicalEquipmentModel);
        $name_page = [
            'name' => 'Cập nhật',
            'total' => 'Thiết bị y tế',
            'route' => 'medical_equipment.index'
        ];
        $equipment_category = EquipmentCategoryModel::get();
        return view('management.medical_equipment.update',
        compact('name_page', 'medicalEquipmentModel','equipment_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalEquipmentModel $medicalEquipmentModel)
    {
        try {
            if(!empty($request->arr)){

                $medical_equipment = $medicalEquipmentModel->update([
                    'series' => $request->arr['series'] ,
                    'name' => $request->arr['name'] ,
                    'image' => $request->arr['image'] ,
                    'status' => $request->arr['status'] ,
                    'production_date' => $request->arr['production_date'] ,
                    'exp_date' => $request->arr['exp_date'] ,
                    'quantity' => $request->arr['quantity'] ,
                    'equipment_category_id' => $request->arr['equipment_category_id'] ,
                    'note' => $request->arr['note'] ,
                ]);


                if(!empty($medical_equipment)){
                    $route = route('medical_equipment.index');
                    return response()->json(['success' => true, 'route' => $route]);

                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }


    public function readFiles(Request $request,MedicalEquipmentModel $medicalEquipmentModel){
        try {

                $name_image= explode('/',$medicalEquipmentModel->image) ?? '';
                $file_size = '';
                if($medicalEquipmentModel->image !== ''){
                    $file_size = filesize($medicalEquipmentModel->image);
                    //dd($file_size);
                }
                $arr[] = [
                    'image' => asset($medicalEquipmentModel->image ?? ''),
                    'name' => $name_image[4] ?? '',
                    'size' => $file_size,
                    'id' => $medicalEquipmentModel->id
                ];
                //dd($arr);
                return response()->json(['status' => "success",'arr' => $arr]);


            //dd($equipmentCategoryModel,$request);


        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function delete_image(Request $request,MedicalEquipmentModel $medicalEquipmentModel){
        try {
            if(!empty($medicalEquipmentModel->image)){
                //$equipmentCategoryModel->medical_equipments()->where('id',$request)->first();
                $name_image= explode('/',$medicalEquipmentModel->image);
                unset($name_image[0], $name_image[1],$name_image[2]);
                $name_image = implode('/',$name_image);
                //dd($name_image,file_exists($medical_equipment->image));
                if(file_exists($medicalEquipmentModel->image)){
                    unlink($medicalEquipmentModel->image);
                    $medicalEquipmentModel->update([
                        'image' => ''
                    ]);
                }
            }
            else{
                //Kiểm tra coi nếu path 1 có ảnh trong project thì xóa k thì sẽ qa path 2 vì $request sẽ lưu cả ảnh đã bị xóa r nên phải làm v
                //dd($request);
                foreach($request->filename as $key => $image){
                    if($key == $request->id){
                        //dd($key,$request);
                        $path = public_path(). '/' .  $image;
                        //dd((file_exists($path)));
                        if(file_exists($path)){
                            File::delete($path);
                        }
                    }
                }

                // else{
                //     $path_2 = public_path(). '/' .  $request->filename[1];
                //     File::delete($path_2);
                // }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalEquipmentModel $medicalEquipmentModel)
    {
        try {
            if($medicalEquipmentModel->delete()){
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
