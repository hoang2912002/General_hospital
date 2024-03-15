<?php

namespace App\Exports;

use App\Models\ManagementModel\UserModel ;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExcelExportUsers implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserModel::query()->select(
            'users.uuid',
            'users.first_name',
            'users.last_name',
            'users.gender',
            'users.dob',
            'logins.email',
            'logins.phone_number',
        )->join('logins', 'users.login_id', 'logins.id')->get();
    }
    public function headings() : array
    {
        return [
            '#',
            'First_name',
            'Last_name',
            'Gender',
            'Dob',
            'Email',
            'Phone_number',
        ];
    }
}
