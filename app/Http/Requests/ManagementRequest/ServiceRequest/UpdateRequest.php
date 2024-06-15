<?php

namespace App\Http\Requests\ManagementRequest\ServiceRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class UpdateRequest extends FormRequest
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
        $id = request()->route()->serviceModel->id;
        return [
            '*.name' => 'required|unique:services,name,' . $id,
            '*.price' => 'required',
            '*.room_id' => 'required',
            '*.description' => 'required',
            '*.thumbnail' => 'sometimes',
            '*.service_image' => 'sometimes',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng không bỏ trống thông tin!',
            'unique' => 'Tên dịch vụ này đã tồn tại!',
            'sometimes' => 'Kiểu tên phòng này không đúng kiểu dữ liệu!'
        ];
    }

}
