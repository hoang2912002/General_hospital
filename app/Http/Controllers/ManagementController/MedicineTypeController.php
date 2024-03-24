<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\CategoryRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\CategoryRequest\UpdateRequest;
use App\Models\ManagementModel\MedicineTypeModel;
use App\Models\ManagementModel\categoryModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MedicineTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name_page = [
            'name' => 'Category Index',
            'total' => 'Medicine Category',
            'route' => 'category.index'
        ];

        if($request->ajax()){

            $categories = MedicineTypeModel::get();
            return DataTables::of($categories)
            ->editColumn('id', function ($category) {
                return '<p class="text-dark  mb-0 font-weight-400">'.$category->id.'</span>';
            })
            ->editColumn('name', function ($category) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$category->name.'</span>';;
            })
            ->editColumn('slug', function ($category) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$category->slug.'</span>';;
            })

            ->addColumn('action', function ($category) {
                $routeDestroy = "'" . route('category.destroy',$category->slug) . "'";
                $route_edit =  '<a href="'. route('category.edit', $category->slug) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit .  '&nbsp'  . $route_delete;
            })

            ->rawColumns(['id','name','slug','action'])
            ->make();
        }
        return view('management.category.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $name_page = [
            'name' => 'Category Create',
            'total' => 'Medicine Category',
            'route' => 'category.index'
        ];
        return view('management.category.create',compact('name_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //dd($request);
        try {
            $category = MedicineTypeModel::create($request->all());
            if(!empty($category)){
                return redirect()->route('category.index')->with('success','Thêm danh mục ' . $request->name . 'thành công!');
            }
            else{
                return back()->with('error','Thêm danh mục thuốc thất bại!');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicineTypeModel $medicineTypeModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicineTypeModel $categoryModel)
    {
        $name_page = [
            'name' => 'Category Update',
            'total' => 'Medicine Category',
            'route' => 'category.index'
        ];
        return view('management.category.update',compact('name_page','categoryModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, MedicineTypeModel $categoryModel)
    {
        try {
            $category = $categoryModel->update($request->all());
            if(!empty($category)){
                return redirect()->route('category.index')->with('success','Cập nhật danh mục ' . $request->name . ' thành công!');
            }
            else{
                return back()->with('error','Cập nhật danh mục thuốc thất bại!');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicineTypeModel $categoryModel)
    {
        //dd(empty($categoryModel->medicines[0]));
        try {
            if(empty($categoryModel->medicines[0])){
                $categoryModel->delete();
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
