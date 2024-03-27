<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\LoginRequest\LoginRequest;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){
        //$this->authorize('viewAny',HomepageController::class);
        $name_page = [
            'name' => 'Homepage',
            'total' => 'Dashboard',
            'route' => 'index'
        ];
        return view('management.homepage',compact('name_page'));
    }

    public function not_found(){
        return view('management.layout.404');
    }
}
