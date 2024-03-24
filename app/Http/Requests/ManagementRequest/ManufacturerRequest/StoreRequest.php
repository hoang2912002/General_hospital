<?php

namespace App\Http\Requests\ManagementRequest\ManufacturerRequest;

use App\Rules\Phone_number;
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
    public function rules()
    {
        return [
            'name' => 'required|unique:manufacturers,name',
            'email' => 'required|email|unique:manufacturers,email',
            'phone_number' => ['required', new Phone_number('Số điện thoại này không đúng định dạng!') , 'unique:manufacturers,phone_number'],
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
