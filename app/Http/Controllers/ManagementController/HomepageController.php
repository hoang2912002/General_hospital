<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\LoginRequest\LoginRequest;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){
        return view('management.homepage');
    }

    
}
