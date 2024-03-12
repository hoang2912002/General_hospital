<?php

namespace App\Http\Requests\ManagementRequest\UserRequest;

use App\Rules\Phone_number;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules()
    {
        $id = request()->route()->userModel->login_id;
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'birthdate' => 'required|date|before:today',
            'gender' => 'required|boolean',
            'email' => 'required|email|unique:logins,email,'.$id,
            'phone_number' => ['required', new Phone_number('Số điện thoại này không đúng định dạng!') , 'unique:logins,phone_number,'.$id],
            'role' => 'required',
            'password' => 'sometimes',
            'activated' => 'required',
            'description' => 'sometimes',
            'avatar' => 'sometimes|image'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'alpha' => 'Điền đúng định dạng tên của bạn!',
            'date' => 'Điền đúng định dạng ngày tháng năm sinh!',
            'boolean' => 'Vui lòng chọn giới tính!',
            'email' => 'Vui lòng điền đúng định dạng tài khoản email!',
            'unique' => 'Trường này đã tồn tại!',
            'min' => 'Vui lòng nhập nhiều hơn 3 ký tự!',
            'max' => 'Vui lòng nhập ít hơn 20 ký tự!',
            'image' => 'Vui lòng đăng đúng file ảnh!'
        ];
    }
    public function passedValidation()
    {
        if($this->filled('password')){
            $this->merge(['password' => bcrypt($this->password)]);
        }
    }
}
