<?php

namespace App\Imports;

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
        $loginID = LoginModel::create([
            'email' => $row['email'],
            'phone_number' => '0' . $row['phone_number'],
            'password' => $row['password'],
            'activated' => $row['activated'],


        ]);
        UserModel::create([
            //dd($row),
            'uuid' => Str::uuid(),
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'gender' => $row['gender'],
            'dob' => date('Y/m/d', strtotime($row['dob'])),
            'login_id' => $loginID->id
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
