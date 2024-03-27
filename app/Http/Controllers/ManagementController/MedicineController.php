<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\MedicineRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\MedicineRequest\UpdateRequest;
use App\Models\ManagementModel\ManufacturerModel;
use App\Models\ManagementModel\MedicineModel;
use App\Models\ManagementModel\MedicineTypeModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',MedicineModel::class);
        $name_page = [
            'name' => 'Mục lục thuốc',
            'total' => 'Thuốc',
            'route' => 'medicine.index'
        ];

        if($request->ajax()){
            $medicines = MedicineModel::get();
            return DataTables::of($medicines)
            ->editColumn('image', function ($medicine) {
                return '<img class="w-10 " src="'. asset($medicine->image) . '" alt="'. $medicine->slug .'">';
            })
            ->editColumn('', function ($medicine) {
                return $medicine->id;
            })
            ->editColumn('name', function ($medicine) {

                return $medicine->name;
            })
            ->editColumn('quantity', function ($medicine) {
                return $medicine->quantity;
            })
            ->editColumn('status', function ($medicine) {
                return $medicine->status();
            })
            ->editColumn('category', function ($medicine) {
                return $medicine->medicines_type->name;
            })
            ->editColumn('manufacturer', function ($medicine) {
                return $medicine->manufacturer->name;
            })
            ->addColumn('action', function ($medicine) {
                $routeDestroy = "'" . route('medicine.destroy',$medicine->slug) . "'";
                $route_edit =  '<a href="'. route('medicine.edit', $medicine->slug) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_detail =  '<a href="'. route('medicine.detail', $medicine->slug) .'" class="badge bg-gradient-success"><i class="fas fa-solid fa-file"></i></a>';

                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $route_detail . '&nbsp'  . $route_delete;
            })
            ->rawColumns(['image','id','name','quantity','status','category','manufacturer','action'])
            ->make();
        }
        return view('management.medicine.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',MedicineModel::class);
        $name_page = [
            'name' => 'Thêm thuốc',
            'total' => 'Thuốc',
            'route' => 'medicine.index'
        ];
        $categories = MedicineTypeModel::get();
        $manufacturers = ManufacturerModel::get();
        return view('management.medicine.create',compact('name_page','categories','manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            //dd($request);
            $price = explode('VNĐ',$request->arr['price']);
            $price = explode('.' , $price[0]);
            $price = implode('',$price);
            $arr = $request->arr;
            $arr['price'] = $price;
            $arr['slug'] = Str::slug($arr['name']);
            //dd($arr);
            $medicine = medicineModel::create($arr);
            if(!empty($medicine)){
                return response()->json(['status' => "success",'message' => "Lưu file thành công",'success' => 'Thêm dịch thuốc thành công!']);
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
                    $dirFolder = 'img/general_hospital/management/medicine_image/';
                    $newfile = $dirFolder . Carbon::now()->getTimestampMs() . '-' . $namefile;
                    //dd(1);

                    $medicine_image[]= $newfile;
                    if(!empty($file)){
                        $file->move($dirFolder, $newfile);
                    }
                }
                //dd($medicine_image);
            }
            return response()->json(['status' => "success",'message' => "Lưu file thành công",'medicine_image' => $newfile,'arr_image' => $medicine_image]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }
    /**
     * Display the specified resource.
     */
    public function detail(MedicineModel $medicineModel)
    {

        $name_page = [
            'name' => 'Chi tiết thuốc',
            'total' => 'Thuốc',
            'route' => 'medicine.index'
        ];
        return view('management.medicine.detail',compact('name_page','medicineModel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicineModel $medicineModel)
    {
        $this->authorize('update',$medicineModel);
        $name_page = [
            'name' => 'Cập nhật thuốc',
            'total' => 'Thuốc',
            'route' => 'medicine.index'
        ];
        $categories = MedicineTypeModel::get();
        $manufacturers = ManufacturerModel::get();
        return view('management.medicine.update',compact('name_page','medicineModel','categories','manufacturers'));
    }

    public function readFiles(Request $request,MedicineModel $medicineModel){
        try {
            $name_image= explode('/',$medicineModel->image) ?? '';
            $file_size = '';
            if($medicineModel->image !== ''){
                $file_size = filesize($medicineModel->image);
            }
            $arr[] = [
                'image' => asset($medicineModel->image ?? ''),
                'name' => $name_image[4] ?? '',
                'size' => $file_size,
            ];
            return response()->json(['status' => "success",'arr' => $arr]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, MedicineModel $medicineModel)
    {
        try {
            $name_page = [
                'name' => 'Mục lục thuốc',
                'total' => 'Thuốc',
                'route' => 'medicine.index'
            ];
            $arr = $request->arr;
            $arr['slug'] =
            Str::slug($request->arr['name']);
            $medicine =  $medicineModel->update($arr);
            if(!empty($medicine)){
                return response()->json(['status' => "success",'message' => "Lưu file thành công",'success' => 'Thêm dịch thuốc thành công!']);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }
    public function delete_image(Request $request,MedicineModel $medicineModel){
        try {
            if(!empty($medicineModel->image)){

                $name_image= explode('/',$request->filename[0]) ?? '';
                unset($name_image[0], $name_image[1],$name_image[2]);
                $name_image = implode('/',$name_image);
                if($medicineModel->image === $request->filename || file_exists($medicineModel->image)){
                    unlink($medicineModel->image);
                    $medicineModel->update([
                        'image' => ''
                    ]);
                }
            }
            else{
                //Kiểm tra coi nếu path 1 có ảnh trong project thì xóa k thì sẽ qa path 2 vì $request sẽ lưu cả ảnh đã bị xóa r nên phải làm v
                $path = public_path(). '/' .  $request->filename[0];
                if(file_exists($path)){
                    File::delete($path);
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
    public function destroy(MedicineModel $medicineModel)
    {
        $this->authorize('delete',$medicineModel);
    }
}
