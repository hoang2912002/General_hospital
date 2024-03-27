<?php

namespace App\Http\Requests\ManagementRequest\MedicineRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.name' => 'required|unique:medicines,name',
            //'slug' => 'sometimes',
            '*.quantity' => 'required',
            '*.price' => 'required',
            '*.category_id' => 'required',
            '*.manufacturer_id' => 'required',
            '*.description' => 'required',
            '*.imp_date' =>'required|date',
            '*.exp_date' => 'required|date',
            '*.image' => 'required',
            '*.activated' => 'sometimes'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'date' => 'Điền đúng định dạng ngày tháng năm!',
            'unique' => 'Trường này đã tồn tại!',
            'image' => 'Vui lòng đăng đúng file ảnh!'
        ];
    }
}
