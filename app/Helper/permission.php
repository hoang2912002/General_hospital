<?php

use Illuminate\Support\Facades\Route;

 if (!function_exists('permission')) {
    function permission()
    {
        $routeCollection = Route::getRoutes();
        //dd(str_contains($routeCollection->getRoutes()[16]->uri(),'admin'));
        foreach ($routeCollection as $value) {
            if((!str_contains($value->uri(),'login')) && ($value->getName() !== 'sanctum.csrf-cookie') && ($value->getName() !== 'ignition.healthCheck') && ($value->getName() !== 'ignition.executeSolution') && ($value->getName() !== 'ignition.updateConfig') ){
                $arr[] =
                ['name' => $value->getName()]
                ;
            }
        }

        $arrayRoute = array_filter($arr,function($v){
            if(str_contains($v['name'], 'index') || str_contains($v['name'], 'create') || str_contains($v['name'], 'update') || str_contains($v['name'], 'destroy')   ){
                return $arrNew[] = ['name'=> $v];
               }
        });
        //dd(array_values($arrayRoute),str_contains($arr[1]['name'], 'index'),$arr);
        return array_values($arrayRoute);

    }
}
