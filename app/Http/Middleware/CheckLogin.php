<?php

namespace App\Http\Middleware;

use App\Models\ManagementModel\GroupModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd(Auth::user()->User->group_user);
        $groups = GroupModel::get();
        $arrUser = ['benh-nhan','user','nguoi-dung'];
        $arrRoles = [];
        foreach($groups as $group){
            //dd($arrR);
            if(!in_array($group,$arrUser)){
                $arrRoles[] = $group->slug;
            }
        }
        //$arrRoles = ['admin','doctor','bac-si'];
        if(Auth::check()){
            $arrRoleUser = [Auth::user()->User->group_user[0]->slug];
                if(in_array($arrRoleUser[0],$arrRoles)){
                    return $next($request);
                }
            return $next($request);
        }
        else{
            return redirect()->route('login.index');
        }
    }
}
