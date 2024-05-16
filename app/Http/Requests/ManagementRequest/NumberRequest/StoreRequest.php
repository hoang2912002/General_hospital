<?php

namespace App\Http\Requests\ManagementRequest\NumberRequest;

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
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required|date|before:today',
            'gender' => 'required|boolean',
            'email' => 'required|email',
            'phone_number' => ['required', new Phone_number('Số điện thoại này không đúng định dạng!')],
            'role' => 'required',

            'activated' => 'sometimes',
            'room_id' => 'required',
            'number' => 'required',
            'patient_identification_code' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'email' => 'Vui lòng điền đúng định dạng tài khoản email!',
            'unique' => 'Trường này đã tồn tại!',
            'min' => 'Vui lòng nhập nhiều hơn 3 ký tự!',
            'confirmed' => 'Mật khẩu không trùng!',
        ];
    }

}
