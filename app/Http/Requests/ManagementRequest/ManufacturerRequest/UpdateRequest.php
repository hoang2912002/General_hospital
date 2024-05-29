<?php

namespace App\Http\Requests\ManagementRequest\ManufacturerRequest;

use App\Rules\Phone_number;
use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        $id = request()->route()->manufacturerModel->id;
        return [
            'name' => 'required|unique:manufacturers,name',
            'activated' => 'required',
            'address' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'email' => 'Vui lòng điền đúng định dạng tài khoản email!',
            'unique' => 'Trường này đã tồn tại!',
        ];
    }
}
