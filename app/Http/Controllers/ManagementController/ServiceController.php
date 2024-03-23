<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\ServiceImageModel;
use App\Models\ManagementModel\ServiceModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name_page = [
            'name' => 'Service Index',
            'total' => 'Service',
            'route' => 'service.index'
        ];

        if($request->ajax()){

            $services = ServiceModel::get();

            return DataTables::of($services)
            ->editColumn('id', function ($service) {
                return '<p class="text-dark  mb-0 font-weight-400">'.$service->id.'</span>';
            })
            ->editColumn('thumbnail', function ($service) {
                return '<img class="w-10 " src="'. $service->thumbnail . '" alt="'. $service->slug .'">';
            })
            ->editColumn('name', function ($service) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$service->name.'</span>';;
            })
            ->editColumn('slug', function ($service) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$service->slug.'</span>';;
            })
            ->editColumn('price', function ($service) {
                return $service->price();
            })
            ->addColumn('action', function ($service) {
                $routeDestroy = "'" . route('service.destroy',$service->slug) . "'";
                $route_edit =  '<a href="'. route('service.edit', $service->slug) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_detail =  '<a href="'. route('service.detail', $service->slug) .'" class="badge bg-gradient-success"><i class="fas fa-solid fa-file"></i></a>';

                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $route_detail . '&nbsp'  . $route_delete;
            })

            ->rawColumns(['id','thumbnail','name','slug','price','action'])
            ->make();
        }
        return view('management.service.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $name_page = [
            'name' => 'Service Create',
            'total' => 'Service',
            'route' => 'service.index'
        ];
        return view('management.service.create',compact('name_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service_info = json_decode($request->arr);
        //dd($service_info->service_image);
        try {
            $price = explode('VNĐ',$service_info->price);
            $price = explode('.' , $price[0]);
            $price = implode('',$price);

            //dd($service_info->service_image);
            $arr = [
                'name' =>$service_info->name,
                'slug' =>Str::slug($service_info->name),
                'thumbnail' =>$service_info->thumbnail,
                'price' =>$price,
                'description' =>$service_info->description,
            ];
            //dd($arr);
            $service = ServiceModel::create($arr);
            if(!empty($service)){
                if(!empty($service_info->service_image)){
                    foreach($service_info->service_image as $image){
                        $serviceImage = ServiceImageModel::create([
                            'service_id' => $service->id,
                            'image' => $image,
                        ]);
                    }
                }

                return response()->json(['status' => "success",'message' => "Lưu file thành công",'success' => 'Thêm dịch vụ thành công!']);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function dropzone(Request $request)
    {
        $service_image = [];
        if($request->hasFile('file')){
            //dd(1);
            $files = $request->file;
            foreach($files as $file){
                $namefile = $file->getClientOriginalName();
                $dirFolder = 'img/general_hospital/management/service_image/';
                $newfile = $dirFolder . Carbon::now()->getTimestampMs() . '-' . $namefile;
                //dd(1);

                $service_image[]= $newfile;
                if(!empty($file)){
                    $file->move($dirFolder, $newfile);
                }
            }
            //dd($service_image);
        }
        return response()->json(['status' => "success",'message' => "Lưu file thành công",'service_image' => $newfile,'arr_image' => $service_image]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceModel $serviceModel)
    {
        dd(1);
    }
    public function readFiles(ServiceModel $serviceModel)
    {
        $name_thumbnail= explode('/',$serviceModel->thumbnail) ?? '';
        $arr = [
            'thumbnail' => asset($serviceModel->thumbnail),
            'name' => $name_thumbnail[4] ?? '',
            'size' => filesize($serviceModel->thumbnail),
        ];
        //dd($arr);
        foreach($serviceModel->image as $image){
            $arr_name_image= explode('/',$image->image) ?? '';
            array_splice($arr_name_image, 0, 3);
            $name_image = implode('/',$arr_name_image);
            //dd(filesize($name_image),$arr_name_image);
            $arr_images[] = [
                'image' => asset($name_image),
                'name' => $arr_name_image[4] ?? '',
                'size' => filesize($name_image),
            ];
        }
        //$arr['images'] = $arr_images;
        //dd($arr_images,$arr);
        return response()->json(['status' => "success",'arr_image' => $arr_images,'arr' => $arr]);
    }
    public function readFilesThumbnail(ServiceModel $serviceModel)
    {
        $name_thumbnail= explode('/',$serviceModel->thumbnail) ?? '';
        $arr[] = [
            'thumbnail' => asset($serviceModel->thumbnail),
            'name' => $name_thumbnail[4] ?? '',
            'size' => filesize($serviceModel->thumbnail),
        ];
        //dd($arr);
        return response()->json(['status' => "success",'arr' => $arr]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceModel $serviceModel)
    {
        $name_page = [
            'name' => 'Service Update',
            'total' => 'Service',
            'route' => 'service.index'
        ];

        return view('management.service.update',compact('name_page','serviceModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceModel $serviceModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceModel $serviceModel)
    {
        //
    }
}
