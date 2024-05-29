<?php

namespace App\Http\Requests\ManagementRequest\UserRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'email' => 'Vui lòng điền đúng định dạng tài khoản email!',
            'unique' => 'Trường này đã tồn tại!',
            'min' => 'Vui lòng nhập nhiều hơn 6 ký tự!',
            'confirmed' => 'Mật khẩu không trùng!',
            'required_with' => 'Vui lòng nhập xác minh mật khẩu mới',
            'same' => 'Trường mật khẩu phải khớp với mật khẩu xác nhận'
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user = $this->route()->userModel->login; // Lấy user hiện tại

            if (!Hash::check($this->old_password, $user->password)) {
                // Mật khẩu cũ không khớp
                $validator->errors()->add('old_password', 'Mật khẩu cũ không đúng.');
            }
        });
    }
    public function passedValidation()
    {
        if($this->filled('password')){
            $this->merge(['password' => bcrypt($this->password)]);
        }
    }
}
