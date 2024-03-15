<?php

namespace App\Http\Requests\ManagementRequest\LoginRequest;

use App\Models\ManagementModel\LoginModel;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        $id_login = LoginModel::where('email', $this->email)->value('id');
        return [
            'email' => 'required|email|unique:logins,email,' . $id_login,
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng điền đầy đủ thông tin!',
            'email' => 'Tài khoản không đúng!',
            'unique' => 'Tài khoản email này chưa đăng ký!'
        ];
    }
}
