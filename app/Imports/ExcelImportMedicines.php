<?php

namespace App\Imports;

use App\Models\ManagementModel\CategoryModel;
use App\Models\ManagementModel\ManufacturerModel;
use App\Models\ManagementModel\MedicineModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class ExcelImportMedicines implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $imp_date = $this->convertDate($row['ngay_nhap']);
        $exp_date = $this->convertDate($row['han_su_dung']);
        //dd($imp_date,$exp_date,$row);
        $manufacturers_slug = ManufacturerModel::pluck('name')->toArray();
        if(!in_array($row['nha_san_xuat'], $manufacturers_slug)){
            ManufacturerModel::create([
                'name' => $row['nha_san_xuat'],
                'address' => $row['nuoc_san_xuat'],
            ]);
        }
        $manufacturer = ManufacturerModel::where('name',$row['nha_san_xuat'])->value('id');
        $categories_slug = CategoryModel::pluck('slug')->toArray();
        if(!in_array(Str::slug($row['loai']), $categories_slug)){
            CategoryModel::create([
                'name' => $row['loai'],
                'slug' => Str::slug($row['loai']),
            ]);
        }
        $category = CategoryModel::where('slug',Str::slug($row['loai']))->value('id');
        $quantity = (int)$row['so_luong'];
        $price = (float)$row['gia'];
        //dd($quantity,$price);
        $medicine_slug = MedicineModel::pluck('slug')->toArray();
        if(!in_array(Str::slug($row['ten']), $medicine_slug)){
            //dd($medicine_slug,Str::slug($row['ten']));
            $medicine = MedicineModel::create([
                'name' => $row['ten'],
                'slug' => Str::slug($row['ten']),
                'quantity' => $quantity,
                'price' => $price,
                'category_id' => $category,
                'manufacturer_id' => $manufacturer,
                'imp_date' => $imp_date,
                'exp_date' => $exp_date,
            ]);
        }


    }
    private function convertDate($date)
    {
        if (is_numeric($date)) {
            $dateTimeObject = Date::excelToDateTimeObject($date);
            return $dateTimeObject->format('Y-m-d');
        } else {
            $dateTimeObject = \DateTime::createFromFormat('d/m/Y', $date);
            if ($dateTimeObject !== false) {
                return $dateTimeObject->format('Y-m-d');
            } else {
                return null; // Hoặc xử lý lỗi theo nhu cầu của bạn
            }
        }
    }
    public function headingRow(): int
    {
        return 1;
    }
}
