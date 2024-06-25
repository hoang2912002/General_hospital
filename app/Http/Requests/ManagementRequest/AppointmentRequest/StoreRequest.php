<?php

namespace App\Http\Requests\ManagementRequest\AppointmentRequest;

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
            'user_uuid' => 'sometimes',
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required|date|before:today',
            'gender' => 'required|boolean',
            'email' => 'required|email',
            'phone_number' => ['required', new Phone_number('Số điện thoại này không đúng định dạng!')],
            'activated' => 'sometimes',
            'patient_identification_code' => 'required',
            'doctor_uuid' => 'required',
            'status' => 'required',
            'note' => 'sometimes',
            'date' => 'required|date',
            'shift_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'email' => 'Vui lòng điền đúng định dạng tài khoản email!',
            'unique' => 'Trường này đã tồn tại!',
            'date' => 'Trường này đã tồn tại!',
            'before' => 'Nhập đúng ngày tháng năm sinh!',
            'after' => 'Vui lòng chọn lại ngày khám!',
        ];
    }
}
