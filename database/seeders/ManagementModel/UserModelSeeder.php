<?php

namespace Database\Seeders\ManagementModel;

use App\Models\ManagementModel\GroupModel;
use App\Models\ManagementModel\GroupUserModel;
use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\PermissionModel;
use App\Models\ManagementModel\RoleModel;
use App\Models\ManagementModel\UserModel;
use Database\Factories\ManagementModel\PermissionModelFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class UserModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $login = LoginModel::factory()->count(1)->create();
        //dd($login[0]->id);
        $user = UserModel::factory()->state(function($each) use($login){

            return [
                'uuid' => Str::uuid(),
                'first_name' => 'Ngô',
                'last_name' => 'Công Hoàng',
                'gender' => 1,
                'dob' => '2002-01-29',
                'login_id'=> $login[0]->id
            ];
        })->create();
        //dd($user['uuid']);
        $group = GroupModel::factory()->count(1)->create();
        $group_user = GroupUserModel::factory()->state(function($each) use($user,$group) {
            return[
                'user_uuid' => $user['uuid'],
                'group_id' => $group[0]->id,
            ];
        })->create();
        $number_of_permission = array_key_last(permission()) + 1;
        $permissions = PermissionModel::factory()->count($number_of_permission)->create();
        foreach($permissions  as $permission ){
            //dd($permission->id);
            $role = RoleModel::factory()->state(function($each) use($permission,$group) {
                return[
                    'group_id' => $group[0]->id,
                    'permission_id' => $permission->id,
                ];
            })->create();
        }
        //dd($permission);

    }
}
