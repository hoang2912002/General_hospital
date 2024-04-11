<?php

namespace App\Imports;

use App\Models\ManagementModel\GroupModel;
use App\Models\ManagementModel\GroupUserModel;
use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\UserModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelImportUsers implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($user);
        $loginID = LoginModel::create([
            'email' => $row['email'],
            'phone_number' => '0' . $row['so_dien_thoai'],
            'password' => bcrypt($row['mat_khau']),
            'activated' => '1'
        ]);

        $user = UserModel::create([
            //dd($row),
            'uuid' => Str::uuid(),
            'first_name' => $row['ten_rieng'],
            'last_name' => $row['ho'],
            'gender' => $row['gioi_tinh'],
            'dob' => date('Y/m/d', strtotime($row['ngay_thang_nam_sinh'])),
            'login_id' => $loginID->id
        ]);
        $groups = GroupModel::pluck('slug')->toArray();
        if(!in_array(Str::slug($row['vi_tri']), $groups)){
            GroupModel::create([
                //dd($row),
                'name' => $row['vi_tri'],
                'slug' => Str::slug($row['vi_tri']),
                'activated' => 1,
            ]);
        }
        $group = GroupModel::where('slug',Str::slug($row['vi_tri']))->value('id');
        GroupUserModel::create([
            'user_uuid' => $user->uuid,
            'group_id' => $group
        ]);

    }
    public function headingRow(): int
    {
        return 1;
    }
}
