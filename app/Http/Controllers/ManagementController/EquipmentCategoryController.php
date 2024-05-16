<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\EquipmentCategoryRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\EquipmentCategoryRequest\UpdateRequest;
use App\Models\ManagementModel\EquipmentCategoryModel;
use App\Models\ManagementModel\MedicalEquipmentModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class EquipmentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', EquipmentCategoryModel::class);
        $name_page = [
            'name' => 'Danh sách',
            'total' => 'Loại thiết bị y tế',
            'route' => 'equipment_category.index'
        ];

        if ($request->ajax()) {

            $equipment_categorys = EquipmentCategoryModel::get();

            return DataTables::of($equipment_categorys)
                ->editColumn('id', function ($equipment_category) {
                    return '<span class="text-dark  mb-0 font-weight-400">' . $equipment_category->id . '</span>';
                })
                ->editColumn('name', function ($equipment_category) {

                    return '<a class="text-dark  mb-0 font-weight-bold" href="' . route('equipment_category.medicalEquipments', $equipment_category->slug) . '">' . $equipment_category->name . '</a>';
                })
                ->editColumn('slug', function ($equipment_category) {

                    return '<span class="text-dark  mb-0 font-weight-400">' . $equipment_category->slug . '</span>';;
                })

                ->addColumn('action', function ($equipment_category) {
                    $routeDestroy = "'" . route('equipment_category.destroy', $equipment_category->slug) . "'";
                    $route_edit =  '<a href="' . route('equipment_category.edit', $equipment_category->slug) . '" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                    $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                    return $route_edit .  '&nbsp'  . $route_delete;
                })

                ->rawColumns(['id', 'name', 'slug', 'action'])
                ->make();
        }
        return view('management.equipment_category.index', compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', EquipmentCategoryModel::class);
        $name_page = [
            'name' => 'Thêm',
            'total' => 'Loại thiết bị y tế',
            'route' => 'equipment_category.index'
        ];
        return view('management.equipment_category.create', compact('name_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            //dd($request);
            $equipment_category = EquipmentCategoryModel::create($request->all());
            if (!empty($equipment_category)) {
                return redirect()->route('equipment_category.index')->with('success', 'Thêm loại thiết bị y tế thành công!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm loại thiết bị y tế thất bại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EquipmentCategoryModel $equipmentCategoryModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EquipmentCategoryModel $equipmentCategoryModel)
    {
        $this->authorize('update', $equipmentCategoryModel);
        $name_page = [
            'name' => 'Cập nhật',
            'total' => 'Loại thiết bị y tế',
            'route' => 'equipment_category.index'
        ];
        return view('management.equipment_category.update', compact('name_page', 'equipmentCategoryModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, EquipmentCategoryModel $equipmentCategoryModel)
    {
        //dd($request);
        try {
            $equipment_category = $equipmentCategoryModel->update($request->all());
            if (!empty($equipment_category)) {
                return redirect()->route('equipment_category.index')->with('success', 'Cập nhật loại thiết bị y tế thành công!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhật loại thiết bị y tế thất bại!');
        }
    }

    public function medicalEquipments(Request $request, EquipmentCategoryModel $equipmentCategoryModel)
    {
        $this->authorize('update', $equipmentCategoryModel);
        try {
            $name_page = [
                'name' => 'Thiết bị y tế',
                'total' => 'Loại thiết bị y tế',
                'route' => 'equipment_category.index'
            ];
            if ($request->ajax()) {

                $medical_equipments = $equipmentCategoryModel->medical_equipments;
                return DataTables::of($medical_equipments)
                    ->editColumn('checkbox', function ($medical_equipment) {
                        return '<div class="form-check">
                    <input class="form-check-input" name="' . $medical_equipment->id . '" value="' . $medical_equipment->id . '"  type="checkbox" id="customCheck1" ></div>';
                    })
                    //<div class="form-check"><input class="form-check-input " type="checkbox" value="all"id="all" name="all"></div>
                    ->editColumn('id', function ($medical_equipment) {
                        return '<span class="text-dark  mb-0 font-weight-400">' . $medical_equipment->id . '</span>';
                    })
                    ->editColumn('image', function ($medical_equipment) {
                        return '<img class="" style="height:40px" src="' . asset($medical_equipment->image) . '" alt="' . $medical_equipment->name . '">';
                    })
                    ->editColumn('name', function ($medical_equipment) {

                        return '<span class="text-dark  mb-0 font-weight-400">' . $medical_equipment->name . '</span>';;
                    })
                    ->editColumn('status', function ($medical_equipment) {

                        return '<span class="text-dark  mb-0 font-weight-400">' . $medical_equipment->status . '</span>';;
                    })
                    ->editColumn('production_date', function ($medical_equipment) {

                        return '<span class="text-dark  mb-0 font-weight-400">' . $medical_equipment->production_date . '</span>';;
                    })
                    ->editColumn('exp_date', function ($medical_equipment) {

                        return '<span class="text-dark  mb-0 font-weight-400">' . $medical_equipment->exp_date . '</span>';;
                    })
                    ->editColumn('quantity', function ($medical_equipment) {

                        return '<span class="text-dark  mb-0 font-weight-400">' . $medical_equipment->quantity . '</span>';;
                    })

                    ->addColumn('action', function ($medical_equipment) {
                        $routeDestroy = "'" . route('medical_equipment.destroy', $medical_equipment->id) . "'";
                        //$route_edit =  '<a href="' . route('medical_equipment.edit', $medical_equipment->id) . '" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                        $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                        return  $route_delete;
                    })

                    ->rawColumns(['checkbox', 'id', 'image', 'name', 'status', 'production_date', 'exp_date', 'quantity', 'action'])
                    ->make();
            }
            return view('management.equipment_category.medical_equipments', compact('name_page', 'equipmentCategoryModel'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function create_medical_equipment(EquipmentCategoryModel $equipmentCategoryModel){
        $name_page = [
            'name' => 'Thêm',
            'total' => 'Thiết bị y tế',
            'route' => 'equipment_category.medicalEquipments',
            'params' => $equipmentCategoryModel
        ];
        return view('management.equipment_category.create_medical_equipment', compact('name_page', 'equipmentCategoryModel'));
    }

    public function store_medical_equipment(Request $request,EquipmentCategoryModel $equipmentCategoryModel){
        //dd($request->arr['series']);
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
                    $route = route('equipment_category.medicalEquipments', ['equipmentCategoryModel' => $equipmentCategoryModel->slug]);
                    return response()->json(['success' => true, 'route' => $route]);

                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function medicalEquipments_api(Request $request, EquipmentCategoryModel $equipmentCategoryModel)
    {
        $arr = $request->arr;
        session()->put('arr_checkbox', $request->arr);
        return response()->json(['equipmentCategoryModel' => $equipmentCategoryModel]);
    }

    public function medicalEquipments_edit(Request $request, EquipmentCategoryModel $equipmentCategoryModel)
    {
        $name_page = [
            'name' => $equipmentCategoryModel->name,
            'total' => 'Thiết bị y tế',
            'route' => 'equipment_category.index'
        ];
        $message = '';
        $arr_checkbox = session('arr_checkbox');
        foreach ($arr_checkbox as $key => $checkbox) {
            $arr_update_medical_equipments[$checkbox] = $equipmentCategoryModel->medical_equipments()->where('id',$checkbox)->first();
        }
        return view('management.equipment_category.medical_equipments_edit',compact('name_page', 'equipmentCategoryModel','arr_update_medical_equipments'));
    }


    public function medicalEquipments_update(Request $request, EquipmentCategoryModel $equipmentCategoryModel){
        //dd($request);
        //dd();
        try {
            if(!empty($request->arr)){
                $medical_equipments = $equipmentCategoryModel->medical_equipments()
                ->where('id', $request->arr['medical_equipment_id'])
                ->get();
                foreach($medical_equipments as $medical_equipment){
                     $medical_equipment = $medical_equipment->update([
                        'series' => $request->arr['series'] ,
                        'name' => $request->arr['name'] ,
                        'image' => $request->arr['image'] ,
                        'status' => $request->arr['status'] ,
                        'production_date' => $request->arr['production_date'] ,
                        'exp_date' => $request->arr['exp_date'] ,
                        'quantity' => $request->arr['quantity'] ,
                        'note' => $request->arr['note'] ,
                    ]);
                }

                if(!empty($medical_equipment)){
                    $route = route('equipment_category.medicalEquipments', ['equipmentCategoryModel' => $equipmentCategoryModel->slug]);
                    return response()->json(['success' => true, 'route' => $route]);

                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

    public function save_image(Request $request){
        try {
            //dd($request);
            if($request->hasFile('file')){
                //dd(1);
                $files = $request->file;

                foreach($files as $file){
                    $namefile = $file->getClientOriginalName();
                    $dirFolder = 'img/general_hospital/management/medical_equipment/';
                    $newfile = $dirFolder . Carbon::now()->getTimestampMs() . '-' . $namefile;
                    //dd(1);

                    $medicine_image[]= $newfile;
                    if(!empty($file)){
                        $file->move($dirFolder, $newfile);
                    }
                }
                //dd($medicine_image);
            }
            return response()->json(['status' => "success",'message' => "Lưu file thành công",'image' => $newfile,'arr_image' => $medicine_image]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

    public function readFiles(Request $request,EquipmentCategoryModel $equipmentCategoryModel){
        try {
            foreach($equipmentCategoryModel->medical_equipments as $medical_equipment){
                if($request->id == $medical_equipment->id){
                    $name_image= explode('/',$medical_equipment->image) ?? '';
                    //dd($name_image);
                    $file_size = '';
                    if($equipmentCategoryModel->image !== ''){
                        $file_size = filesize($medical_equipment->image);
                    }
                    $arr[] = [
                        'image' => asset($medical_equipment->image ?? ''),
                        'name' => $name_image[4] ?? '',
                        'size' => $file_size,
                        'id' => $medical_equipment->id
                    ];
                    //dd($arr);
                    return response()->json(['status' => "success",'arr' => $arr]);
                }
            };
            //dd($equipmentCategoryModel,$request);


        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function delete_image(Request $request,EquipmentCategoryModel $equipmentCategoryModel){
        try {
            $medical_equipment = $equipmentCategoryModel->medical_equipments()->where('id',$request->id)->first();

            if(!empty($medical_equipment->image)){
                //$equipmentCategoryModel->medical_equipments()->where('id',$request)->first();
                $name_image= explode('/',$medical_equipment->image);
                unset($name_image[0], $name_image[1],$name_image[2]);
                $name_image = implode('/',$name_image);
                //dd($name_image,file_exists($medical_equipment->image));
                if(file_exists($medical_equipment->image)){
                    //dd(1);
                    unlink($medical_equipment->image);
                    $medical_equipment->update([
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
    public function delete_imageCreate( Request $request){
        try {
            if(!empty($request->filename[0])){
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
    public function destroy(EquipmentCategoryModel $equipmentCategoryModel)
    {
        $this->authorize('delete', $equipmentCategoryModel);
        try {
            if (empty($equipmentCategoryModel->medical_equipments[0])) {
                $equipmentCategoryModel->delete();
                return 1;
            } else {
                return 0;
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
